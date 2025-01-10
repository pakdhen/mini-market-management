<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource (menampilkan daftar stok).
     */
    public function index()
    {
        // Mengambil semua data stok dari database
        $transactions = Transaction::all();

        // Mengirim data stok ke view
        return view('transactions.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource (form untuk menambah stok).
     */
    public function create()
    {
        // Mengambil data produk untuk dipilih saat menambah stok
        $transactions = Transaction::all();

        // Menampilkan halaman form untuk menambah stok
        return view('transactions.create', compact('transactions'));
    }

    /**
     * Store a newly created resource in storage (menyimpan stok ke database).
     */
    public function store(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'transaction_date' => 'required|exists:transaction,id',
            'user_id' => 'required|exists:users,id',
            'branch_id' => 'required|exists:branches,id',
            'total_price' => 'required|integer|min:1',
            
        ]);

        // Menyimpan stok baru ke database
        Transaction::create([
            'transaction_date' => $request->transaction_date,
            'user_id' => $request->user_id,
            'branch_id' => $request->branch_id,
            'total_price' => $request->total_price,
        ]);

        // Redirect ke halaman daftar stok dengan pesan sukses
        return redirect()->route('stocks')->with('success', 'Stok berhasil ditambahkan!');
    }

    /**
     * Display the specified resource (menampilkan detail stok).
     */
    public function show(Transaction $transaction)
    {
        // Menampilkan detail stok berdasarkan ID stok
        return view('transactions.show', compact('transaction'));
    }

    /**
     * Show the form for editing the specified resource (form untuk mengedit stok).
     */
    public function edit(Transaction $transactions)
    {
        // Mengambil data produk dan cabang untuk form edit
        $products = Transaction::all();

        // Menampilkan form edit stok dengan data produk yang sesuai
        return view('transactions.edit', compact('transactions', 'products'));
    }

    /**
     * Update the specified resource in storage (memperbarui stok di database).
     */
    // public function update(Request $request, Transaction $stock)
    // {
    //     // Validasi input dari form
    //     $request->validate([
    //         'quantity' => 'required|integer|min:1',  // Validasi stok yang diperbarui
    //     ]);

    //     // Memperbarui jumlah stok di database
    //     $stock->update([
    //         'quantity' => $request->quantity,
    //     ]);

    //     // Redirect ke halaman daftar stok dengan pesan sukses
    //     return redirect()->route('stocks')->with('success', 'Stok berhasil diperbarui!');
    // }

    /**
     * Remove the specified resource from storage (menghapus stok dari database).
     */
    public function destroy(Transaction $transaction)
    {
        // Menghapus stok dari database
        $transaction->delete();

        // Redirect ke halaman daftar stok dengan pesan sukses
        return redirect()->route('transactions')->with('success', 'Transaksi berhasil dihapus!');
    }
}
