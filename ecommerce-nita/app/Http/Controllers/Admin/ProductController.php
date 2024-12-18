<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Produk; // Menggunakan model Produk
use Illuminate\Http\Request;
use Illuminate\Support\Str; // Untuk memanipulasi string

class ProductController extends Controller
{
    public function index()
    {
        $products = Produk::all(); // Mengambil semua data dari model Produk
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi file gambar
        ]);

        $data = $request->all();

        // Proses unggah gambar
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = Str::random(10) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName); // Simpan di folder public/images
            $data['image'] = 'images/' . $imageName;
        }

        Produk::create($data); // Simpan data ke model Produk
        return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
    }

    public function edit(Produk $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, Produk $product)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi file gambar opsional
        ]);

        $data = $request->all();

        // Proses unggah gambar jika ada
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = Str::random(10) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName); // Simpan di folder public/images
            $data['image'] = 'images/' . $imageName;
        }

        $product->update($data); // Update data di model Produk
        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Produk $product)
    {
        // Hapus gambar dari public folder
        if ($product->image && file_exists(public_path($product->image))) {
            unlink(public_path($product->image));
        }

        $product->delete(); // Hapus data dari model Produk
        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }
}
