<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::all();
        return view('admin.transactions.index', compact('transactions'));
    }

    public function show($id)
    {
        $transaction = Transaction::findOrFail($id);
        $cartData = json_decode(decrypt($transaction->cart_data), true);

        return view('admin.transactions.show', compact('transaction', 'cartData'));
    }

    public function updateStatus($id, $status)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->update(['status' => $status]);

        return redirect()->back()->with('success', 'Transaction status updated successfully.');
    }
}
