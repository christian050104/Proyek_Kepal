<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Produk; // Menggunakan model Produk

class MemberProductController extends Controller
{
    public function index()
    {
        $products = Produk::all(); // Mengambil semua data dari model Produk
        return view('member.products.index', compact('products'));
    }

    public function show($id)
    {
        $product = Produk::findOrFail($id); // Mengambil data berdasarkan ID
        return view('member.products.show', compact('product'));
    }
}
