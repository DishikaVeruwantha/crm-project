<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Customer;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use App\Mail\InvoiceMail;
use Illuminate\Support\Facades\Mail;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;

class InvoiceController extends Controller
{
    // Show all invoices
    public function index(): Response
    {
        return Inertia::render('Invoices/Index', [
            'invoices' => Invoice::with('customer')->orderBy('created_at', 'desc')->get()
        ]);
    }

    // Show form to create invoice
    public function create(): Response
    {
        return Inertia::render('Invoices/Create', [
            'customers' => Customer::all()
        ]);
    }

    // Store new invoice
    public function store(Request $request)
    {
        $data = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'title' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'due_date' => 'required|date',
            'status' => 'nullable|string',
        ]);

        Invoice::create($data);

        return redirect()->route('invoices.index')->with('success', 'Invoice created.');
    }

    // Show form to edit invoice
    public function edit(Invoice $invoice): Response
    {
        return Inertia::render('Invoices/Edit', [
            'invoice' => $invoice->load('customer'),
            'customers' => Customer::all()
        ]);
    }

    // Update invoice
    public function update(Request $request, Invoice $invoice)
    {
        $data = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'title' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'due_date' => 'required|date',
            'status' => 'nullable|string',
        ]);

        $invoice->update($data);

        return redirect()->route('invoices.index')->with('success', 'Invoice updated.');
    }

    // Delete invoice
    public function destroy(Invoice $invoice)
    {
        $invoice->delete();

        return redirect()->route('invoices.index')->with('success', 'Invoice deleted.');
    }

    // Toggle invoice status (e.g., unpaid <-> paid)
    public function toggleStatus(Invoice $invoice)
    {
        $invoice->status = $invoice->status === 'paid' ? 'unpaid' : 'paid';
        $invoice->save();

        return redirect()->route('invoices.index')->with('success', 'Invoice status updated.');
    }

    // Mark invoice as sent
    public function sendInvoice(Invoice $invoice)
    {
        $invoice->sent = true;
        $invoice->save();

        // Get the customer
        $customer = $invoice->customer;

        // Set your Stripe secret key
        Stripe::setApiKey(env('STRIPE_SECRET'));

        // Create a Stripe Checkout Session
        $session = StripeSession::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'unit_amount' => (int) ($invoice->amount * 100), // amount in cents
                    'product_data' => [
                        'name' => $invoice->title ?? 'Invoice Payment',
                    ],
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('stripe.success', [
                'invoice' => $invoice->id,
                'session_id' => '{CHECKOUT_SESSION_ID}',
            ]),
            'cancel_url' => route('stripe.cancel', $invoice),
            'metadata' => [
                'invoice_id' => $invoice->id,
            ]
        ]);

        // Send the email with Stripe URL
        if ($customer && $customer->email) {
            Mail::to($customer->email)->send(new InvoiceMail($invoice, $session->url));
        }

        return redirect()->route('invoices.index')->with('success', 'Invoice sent and payment link generated.');
    }

    public function paymentSuccess(Invoice $invoice)
    {
        $invoice->status = 'paid';
        $invoice->save();

        Transaction::create([
            'invoice_id' => $invoice->id,
            'amount' => $invoice->amount,
            'transaction_date' => now(),
        ]);

        // Redirect to a minimal confirmation page
        return view('payment_success');
    }

}
