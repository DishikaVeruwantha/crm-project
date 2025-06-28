<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Customer;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

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

        return redirect()->route('invoices.index')->with('success', 'Invoice marked as sent.');
    }
}
