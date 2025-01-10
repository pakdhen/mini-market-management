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
}
