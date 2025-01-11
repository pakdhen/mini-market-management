<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource (tampilkan semua cabang).
     */
    public function index()
    {
        // Mengambil semua data cabang dari database
        $branches = Branch::all();

        // Mengirim data cabang ke view
        return view('branches.index', compact('branches'));
    }

    public function show(Branch $branch)
    {
        // Ambil data stok produk, transaksi, dan pegawai terkait dengan cabang
        $stocks = $branch->stocks()->with('product')->get();
        $transactions = $branch->transactions()->with('details.product')->get();
        $employees = $branch->employees;

        return view('branches.show', compact('branch', 'stocks', 'transactions', 'employees'));
    }
}
