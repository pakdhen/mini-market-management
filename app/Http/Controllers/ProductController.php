<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource (menampilkan semua produk).
     */
    public function index()
    {
        // Mengambil semua data produk dari database
        $products = Product::all();

        // Mengirim data produk ke view
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource (form untuk menambah produk).
     */
    public function create()
    {
        // Menampilkan halaman form untuk menambah produk
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage (menyimpan produk ke database).
     */
    public function store(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
        ]);

        // Menyimpan data produk ke database
        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
        ]);

        // Redirect ke halaman daftar produk dengan pesan sukses
        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    /**
     * Display the specified resource (menampilkan detail produk).
     */
    public function show(Product $product)
    {
        // Menampilkan halaman detail produk
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource (form untuk mengedit produk).
     */
    public function edit(Product $product)
    {
        // Menampilkan form untuk mengedit produk
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage (memperbarui produk di database).
     */
    public function update(Request $request, Product $product)
    {
        // Validasi input dari form
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
        ]);

        // Memperbarui data produk di database
        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
        ]);

        // Redirect ke halaman daftar produk dengan pesan sukses
        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage (menghapus produk dari database).
     */
    public function destroy(Product $product)
    {
        // Menghapus produk dari database
        $product->delete();

        // Redirect ke halaman daftar produk dengan pesan sukses
        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus!');
    }
}
