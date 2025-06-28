<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class CustomerController extends Controller
{
    // Show all customers
    public function index(): Response
    {
        return Inertia::render('Customers/Index', [
            'customers' => Customer::orderBy('created_at', 'desc')->get()
        ]);
    }

    // Show form to create a customer
    public function create(): Response
    {
        return Inertia::render('Customers/Create');
    }

    // Store new customer
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'nullable|email|unique:customers,email',
            'phone' => 'nullable|string',
        ]);

        Customer::create($data);

        return redirect()->route('customers.index')->with('success', 'Customer created.');
    }

    // Show form to edit a customer
    public function edit(Customer $customer): Response
    {
        return Inertia::render('Customers/Edit', [
            'customer' => $customer
        ]);
    }

    // Update customer
    public function update(Request $request, Customer $customer)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:customers,email,' . $customer->id,
            'phone' => 'nullable|string',
        ]);

        $customer->update($data);

        return redirect()->route('customers.index')->with('success', 'Customer updated.');
    }

    // Delete customer
    public function destroy(Customer $customer)
    {
        $customer->delete();

        return redirect()->route('customers.index')->with('success', 'Customer deleted.');
    }

    // Toggle customer active/inactive status
    public function toggleStatus(Customer $customer)
    {
        $customer->status = !$customer->status; // toggle true/false
        $customer->save();

        return redirect()->route('customers.index')->with('success', 'Customer status updated.');
    }
}
