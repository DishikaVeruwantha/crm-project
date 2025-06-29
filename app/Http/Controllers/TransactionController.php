<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Transaction;

class TransactionController extends Controller
{
    public function index(): \Inertia\Response
    {
        return Inertia::render('Transactions/Index', [
            'transactions' => Transaction::with('invoice.customer')->latest()->get()
        ]);
    }
}
