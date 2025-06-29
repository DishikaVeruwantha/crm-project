<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProposalController;
use App\Http\Controllers\TransactionController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('customers')->middleware(['auth'])->group(function () {
    Route::get('/', [CustomerController::class, 'index'])->name('customers.index');
    Route::get('/create', [CustomerController::class, 'create'])->name('customers.create');
    Route::post('/', [CustomerController::class, 'store'])->name('customers.store');
    Route::get('/{customer}/edit', [CustomerController::class, 'edit'])->name('customers.edit');
    Route::put('/{customer}', [CustomerController::class, 'update'])->name('customers.update');
    Route::delete('/{customer}', [CustomerController::class, 'destroy'])->name('customers.destroy');
    Route::patch('/{customer}/status', [CustomerController::class, 'toggleStatus'])->name('customers.toggleStatus');
});


Route::prefix('proposals')->middleware(['auth'])->group(function () {
    Route::get('/', [ProposalController::class, 'index'])->name('proposals.index');
    Route::get('/create', [ProposalController::class, 'create'])->name('proposals.create');
    Route::post('/', [ProposalController::class, 'store'])->name('proposals.store');
    Route::get('/{proposal}/edit', [ProposalController::class, 'edit'])->name('proposals.edit');
    Route::put('/{proposal}', [ProposalController::class, 'update'])->name('proposals.update');
    Route::delete('/{proposal}', [ProposalController::class, 'destroy'])->name('proposals.destroy');
    Route::patch('/{proposal}/status', [ProposalController::class, 'toggleStatus'])->name('proposals.toggleStatus');
});

Route::prefix('invoices')->middleware(['auth'])->group(function () {
    Route::get('/', [InvoiceController::class, 'index'])->name('invoices.index');
    Route::get('/create', [InvoiceController::class, 'create'])->name('invoices.create');
    Route::post('/', [InvoiceController::class, 'store'])->name('invoices.store');
    Route::get('/{invoice}/edit', [InvoiceController::class, 'edit'])->name('invoices.edit');
    Route::put('/{invoice}', [InvoiceController::class, 'update'])->name('invoices.update');
    Route::delete('/{invoice}', [InvoiceController::class, 'destroy'])->name('invoices.destroy');
    Route::patch('/{invoice}/status', [InvoiceController::class, 'toggleStatus'])->name('invoices.toggleStatus');
    Route::patch('/{invoice}/send', [InvoiceController::class, 'sendInvoice'])->name('invoices.send');
});

Route::get('/stripe/success/{invoice}', [InvoiceController::class, 'paymentSuccess'])->name('stripe.success');

Route::get('/stripe/cancel/{invoice}', [InvoiceController::class, 'paymentCancel'])->name('stripe.cancel');


Route::get('/transactions', [TransactionController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('transactions.index');

require __DIR__.'/auth.php';
