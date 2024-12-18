<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class TransactionController extends Controller
{
    // Menampilkan Form Checkout
    public function checkoutForm()
    {
        $cart = session()->get('cart', []);
        return view('member.checkout.form', compact('cart'));
    }

    // Memproses Checkout
    public function processCheckout(Request $request)
    {
        $request->validate([
            'address' => 'required|string',
            'phone' => 'required|string',
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('member.cart.index')->with('error', 'Your cart is empty.');
        }

        // Simpan data transaksi
        $transaction = Transaction::create([
            'user_id' => auth()->id(),
            'cart' => Crypt::encryptString(json_encode($cart)), // Enkripsi data keranjang
            'address' => Crypt::encryptString($request->address), // Enkripsi alamat
            'phone' => Crypt::encryptString($request->phone), // Enkripsi nomor telepon
            'total' => array_sum(array_map(fn ($item) => $item['price'] * $item['quantity'], $cart)),
        ]);

        // Hapus keranjang dari session
        session()->forget('cart');

        return redirect()->route('member.transactions.show', Crypt::encryptString($transaction->id))
            ->with('success', 'Your order has been placed successfully!');
    }

    // Menampilkan Detail Transaksi
    public function showTransaction($encryptedId)
    {
        $transactionId = Crypt::decryptString($encryptedId);
        $transaction = Transaction::findOrFail($transactionId);

        $cart = json_decode(Crypt::decryptString($transaction->cart), true);
        $address = Crypt::decryptString($transaction->address);
        $phone = Crypt::decryptString($transaction->phone);

        return view('member.transactions.show', compact('transaction', 'cart', 'address', 'phone'));
    }
}
