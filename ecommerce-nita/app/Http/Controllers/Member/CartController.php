<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // Menampilkan Keranjang
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('member.cart.index', compact('cart'));
    }

    // Menambahkan Produk ke Keranjang
    public function add($id, Request $request)
    {
        $product = Produk::findOrFail($id);

        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
                'image' => $product->image,
            ];
        }
        session()->put('cart', $cart);

        return redirect()->route('member.cart.index')->with('success', 'Product added to cart!');
    }

    // Mengurangi Jumlah Produk di Keranjang
    public function decrement($id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            if ($cart[$id]['quantity'] > 1) {
                $cart[$id]['quantity']--;
            } else {
                unset($cart[$id]);
            }
        }
        session()->put('cart', $cart);

        return redirect()->route('member.cart.index')->with('success', 'Product quantity updated!');
    }

    // Menghapus Produk dari Keranjang
    public function remove($id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
        }
        session()->put('cart', $cart);

        return redirect()->route('member.cart.index')->with('success', 'Product removed from cart!');
    }
}
