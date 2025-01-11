<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\Product; // Pastikan Anda memiliki relasi dengan model Product
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class StockController extends Controller
{
    /**
     * Display a listing of the resource (menampilkan daftar stok).
     */
    public function index()
    {
        // Ambil branch_id dari pengguna yang sedang login
        $branchId = Auth::user()->branch_id;

        // Mengambil semua data stok yang ada di cabang pengguna yang sedang login
        $stocks = Stock::with('product')->where('branch_id', $branchId)->get();

        // Mengambil nama cabang dari pengguna yang sedang login
        $branchName = Auth::user()->branch->name;

        // Mengirim data stok ke view
        return view('stocks.index', compact('stocks', 'branchName'));
    }

    /**
     * Show the form for creating a new resource (form untuk menambah stok).
     */
    public function create()
    {
        $branchId = Auth::user()->branch_id;

         // Ambil produk yang belum memiliki stok di cabang pengguna yang sedang login
         $products = Product::whereDoesntHave('stocks', function ($query) use ($branchId) {
            $query->where('branch_id', $branchId);
        })->get();

        // Menampilkan halaman form untuk menambah stok
        return view('stocks.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage (menyimpan stok ke database).
     */
    public function store(Request $request)
    {
        // Ambil branch_id dari pengguna yang sedang login
        $branchId = Auth::user()->branch_id;

        // Validasi input dari form
        $request->validate([
            'product_id' => 'required|exists:products,id|unique:stocks,product_id,NULL,id,branch_id,' . $branchId,  // Validasi apakah produk ada dan unik untuk branch_id
            // 'product_id' => 'required|exists:products,id',  // Validasi apakah produk ada
            'quantity' => 'required|integer|min:1',         // Validasi stok yang ditambah
            // 'branch_id' => 'required|exists:branches,id',   // Validasi cabang tempat produk
        ]);

        // Menyimpan stok baru ke database
        Stock::create([
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'branch_id' => $branchId,
        ]);

        // Redirect ke halaman daftar stok dengan pesan sukses
        return redirect()->route('stocks')->with('success', 'Stok berhasil ditambahkan!');
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
        return redirect()->route('stocks')->with('success', 'Stok berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage (menghapus stok dari database).
     */
    public function destroy(Stock $stock)
    {
        // Menghapus stok dari database
        $stock->delete();

        // Redirect ke halaman daftar stok dengan pesan sukses
        return redirect()->route('stocks')->with('success', 'Stok berhasil dihapus!');
    }
}
