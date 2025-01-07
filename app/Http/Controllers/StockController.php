<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\Product; // Pastikan Anda memiliki relasi dengan model Product
use Illuminate\Http\Request;

class StockController extends Controller
{
    /**
     * Display a listing of the resource (menampilkan daftar stok).
     */
    public function index()
    {
        // Mengambil semua data stok dari database
        $stocks = Stock::all();

        // Mengirim data stok ke view
        return view('stocks.index', compact('stocks'));
    }

    /**
     * Show the form for creating a new resource (form untuk menambah stok).
     */
    public function create()
    {
        // Mengambil data produk untuk dipilih saat menambah stok
        $products = Product::all();

        // Menampilkan halaman form untuk menambah stok
        return view('stocks.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage (menyimpan stok ke database).
     */
    public function store(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'product_id' => 'required|exists:products,id',  // Validasi apakah produk ada
            'quantity' => 'required|integer|min:1',         // Validasi stok yang ditambah
            'branch_id' => 'required|exists:branches,id',   // Validasi cabang tempat produk
        ]);

        // Menyimpan stok baru ke database
        Stock::create([
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'branch_id' => $request->branch_id,
        ]);

        // Redirect ke halaman daftar stok dengan pesan sukses
        return redirect()->route('stocks.index')->with('success', 'Stok berhasil ditambahkan!');
    }

    /**
     * Display the specified resource (menampilkan detail stok).
     */
    public function show(Stock $stock)
    {
        // Menampilkan detail stok berdasarkan ID stok
        return view('stocks.show', compact('stock'));
    }

    /**
     * Show the form for editing the specified resource (form untuk mengedit stok).
     */
    public function edit(Stock $stock)
    {
        // Mengambil data produk dan cabang untuk form edit
        $products = Product::all();

        // Menampilkan form edit stok dengan data produk yang sesuai
        return view('stocks.edit', compact('stock', 'products'));
    }

    /**
     * Update the specified resource in storage (memperbarui stok di database).
     */
    public function update(Request $request, Stock $stock)
    {
        // Validasi input dari form
        $request->validate([
            'quantity' => 'required|integer|min:1',  // Validasi stok yang diperbarui
        ]);

        // Memperbarui jumlah stok di database
        $stock->update([
            'quantity' => $request->quantity,
        ]);

        // Redirect ke halaman daftar stok dengan pesan sukses
        return redirect()->route('stocks.index')->with('success', 'Stok berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage (menghapus stok dari database).
     */
    public function destroy(Stock $stock)
    {
        // Menghapus stok dari database
        $stock->delete();

        // Redirect ke halaman daftar stok dengan pesan sukses
        return redirect()->route('stocks.index')->with('success', 'Stok berhasil dihapus!');
    }
}
