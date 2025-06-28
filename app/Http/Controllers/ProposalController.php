<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use App\Models\Customer;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ProposalController extends Controller
{
    // Show all proposals
    public function index(): Response
    {
        return Inertia::render('Proposals/Index', [
            'proposals' => Proposal::with('customer')->orderBy('created_at', 'desc')->get()
        ]);
    }

    // Show form to create a proposal
    public function create(): Response
    {
        return Inertia::render('Proposals/Create', [
            'customers' => Customer::all() // for dropdown to select customer
        ]);
    }

    // Store a new proposal
    public function store(Request $request)
    {
        $data = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'title' => 'required|string',
            'amount' => 'required|numeric',
            'status' => 'nullable|string', // default can be applied in model or migration
        ]);

        Proposal::create($data);

        return redirect()->route('proposals.index')->with('success', 'Proposal created.');
    }

    // Show form to edit a proposal
    public function edit(Proposal $proposal): Response
    {
        return Inertia::render('Proposals/Edit', [
            'proposal' => $proposal->load('customer'),
            'customers' => Customer::all()
        ]);
    }

    // Update a proposal
    public function update(Request $request, Proposal $proposal)
    {
        $data = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'title' => 'required|string',
            'amount' => 'required|numeric',
            'status' => 'nullable|string',
        ]);

        $proposal->update($data);

        return redirect()->route('proposals.index')->with('success', 'Proposal updated.');
    }

    // Delete a proposal
    public function destroy(Proposal $proposal)
    {
        $proposal->delete();

        return redirect()->route('proposals.index')->with('success', 'Proposal deleted.');
    }

    // Toggle status (e.g., draft <-> approved)
    public function toggleStatus(Proposal $proposal)
    {
        $proposal->status = $proposal->status === 'approved' ? 'draft' : 'approved';
        $proposal->save();

        return redirect()->route('proposals.index')->with('success', 'Proposal status updated.');
    }
}
