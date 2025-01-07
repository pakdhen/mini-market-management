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

    /**
     * Show the form for creating a new resource (form untuk menambah cabang).
     */
    public function create()
    {
        // Menampilkan halaman form untuk menambah cabang
        return view('branches.create');
    }

    /**
     * Store a newly created resource in storage (menyimpan data cabang ke database).
     */
    public function store(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
        ]);

        // Menyimpan data cabang ke database
        Branch::create([
            'name' => $request->name,
            'address' => $request->address,
        ]);

        // Redirect ke halaman cabang dengan pesan sukses
        return redirect()->route('branches.index')->with('success', 'Cabang berhasil ditambahkan!');
    }

    /**
     * Display the specified resource (tampilkan detail cabang).
     */
    public function show(Branch $branch)
    {
        // Menampilkan detail cabang berdasarkan ID
        return view('branches.show', compact('branch'));
    }

    /**
     * Show the form for editing the specified resource (form untuk mengedit cabang).
     */
    public function edit(Branch $branch)
    {
        // Menampilkan form untuk mengedit cabang
        return view('branches.edit', compact('branch'));
    }

    /**
     * Update the specified resource in storage (update data cabang ke database).
     */
    public function update(Request $request, Branch $branch)
    {
        // Validasi input dari form
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
        ]);

        // Update data cabang berdasarkan ID
        $branch->update([
            'name' => $request->name,
            'address' => $request->address,
        ]);

        // Redirect ke halaman cabang dengan pesan sukses
        return redirect()->route('branches.index')->with('success', 'Cabang berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage (menghapus cabang dari database).
     */
    public function destroy(Branch $branch)
    {
        // Menghapus data cabang dari database
        $branch->delete();

        // Redirect ke halaman cabang dengan pesan sukses
        return redirect()->route('branches.index')->with('success', 'Cabang berhasil dihapus!');
    }
}
