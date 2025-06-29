<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Proposal;
use App\Models\Invoice;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    public function index(): Response
    {
        $stats = [
            'total_customers' => Customer::count(),
            'pending_proposals' => Proposal::where('status', 'draft')->count(),
            'invoices_sent' => Invoice::where('sent', true)->count(),
            'revenue_this_month' => Invoice::whereMonth('created_at', now()->month)->sum('amount'),
        ];

        return Inertia::render('Dashboard', [
            'stats' => $stats,
        ]);
    }
}
