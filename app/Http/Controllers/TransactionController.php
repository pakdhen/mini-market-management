<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class TransactionController extends Controller
{
    public function index()
    {
        // $transactions = Transaction::with('user', 'details.product')->get();
        // $users = User::all(); // Ambil semua pengguna
        // $products = Product::all(); // Ambil semua produk
        // return view('transactions.index', compact('transactions', 'users', 'products'));
        // $transactions = Transaction::with('user', 'details.product')->get();
        // Ambil branch_id dari pengguna yang sedang login
        $branchId = Auth::user()->branch_id;

        // Mengambil semua data stok yang ada di cabang pengguna yang sedang login
        $transactions = Transaction::with('details')->where('branch_id', $branchId)->get();
        return view('transactions.index', compact('transactions'));
    }

    public function create()
    {
        $products = Product::all();
        $branchId = Auth::user()->branch_id; // Ambil ID cabang pengguna yang sedang login
        // $users = User::role('Kasir')->where('branch_id', $branchId)->get(); // Ambil semua pengguna dengan peran "Kasir" di cabang yang sama
        $users = User::whereHas('roles', function($query) {
            $query->where('name', 'Kasir');
        })->where('branch_id', $branchId)
          ->whereDoesntHave('roles', function($query) {
              $query->where('name', 'Supervisor');
          })->get(); // Ambil semua pengguna dengan peran "Kasir" di cabang yang sama dan bukan "Supervisor"
        return view('transactions.create', compact('products', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'details' => 'required|array',
            'details.*.product_id' => 'required|exists:products,id',
            'details.*.quantity' => 'required|integer|min:1',
        ]);

        $transaction = Transaction::create([
            'transaction_date' => now(),
            'user_id' => $request->user_id,
            'branch_id' => Auth::user()->branch_id,
            'total_price' => 0,
        ]);

        $totalPrice = 0;
        foreach ($request->details as $detail) {
            $product = Product::find($detail['product_id']);
            $totalPrice += $product->price * $detail['quantity'];
            $transaction->details()->create([
                'product_id' => $detail['product_id'],
                'quantity' => $detail['quantity'],
                'price' => $product->price,
            ]);
        }

        $transaction->update(['total_price' => $totalPrice]);

        return redirect()->route('transactions')->with('success', 'Transaksi berhasil ditambahkan.');
    }

    public function print()
    {
        // $transactions = Transaction::with('user', 'details.product')->get();
        // $pdf = Pdf::loadView('transactions.print', compact('transactions'));
        // return $pdf->download('transactions.pdf');
        $user = Auth::user();
    
        // Menyaring transaksi berdasarkan cabang pengguna yang login
        $transactions = Transaction::with('user', 'details.product')
            ->where('branch_id', $user->branch_id) // Pastikan ada field 'branch_id' di tabel transaksi
            ->get();
        
        // Membuat PDF dengan transaksi yang telah difilter
        $pdf = Pdf::loadView('transactions.print', compact('transactions'));
        
        return $pdf->download('transactions.pdf');
    }
}