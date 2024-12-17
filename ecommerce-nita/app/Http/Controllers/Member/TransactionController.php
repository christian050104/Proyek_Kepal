<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function checkout(Request $request)
    {
        $cart = session()->get('cart');

        if (!$cart) {
            return redirect()->route('member.cart.index')->with('error', 'Your cart is empty!');
        }

        $transaction = Transaction::create([
            'user_id' => Auth::id(),
            'cart_data' => encrypt(json_encode($cart)),
            'status' => 'pending',
        ]);

        session()->forget('cart');

        return redirect()->route('member.transactions.show', $transaction->id)
            ->with('success', 'Transaction successfully created!');
    }

    public function show($id)
    {
        $transaction = Transaction::findOrFail($id);
        $cartData = json_decode(decrypt($transaction->cart_data), true);

        return view('member.transactions.show', compact('transaction', 'cartData'));
    }
}
