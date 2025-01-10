<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Product;
use App\Models\Sale;
use App\Models\Stock;
use App\Models\Transaction;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBranches = Branch::count();
        $totalProducts = Product::count();
        $totalSales = Transaction::sum('total_price');
        $totalStock = Stock::sum('quantity');
        // $salesByMonth = Transaction::selectRaw('MONTH(created_at) as month, SUM(total_price) as total')
        //                     ->groupBy('month')
        //                     ->pluck('total', 'month');
        // $stockByProduct = Stock::selectRaw('product_id, SUM(quantity) as total')
        //                     ->groupBy('product_id')
        //                     ->with('product')
        //                     ->get()
        //                     ->pluck('total', 'product.name');

        // Ambil semua cabang
        $branches = Branch::all();

        // Ambil penjualan per cabang
        $salesByBranch = Transaction::selectRaw('branch_id, SUM(total_price) as total')
                            ->groupBy('branch_id')
                            ->pluck('total', 'branch_id');

        // Gabungkan semua cabang dengan penjualan per cabang
        $salesByBranchData = [];
        foreach ($branches as $branch) {
            $salesByBranchData[$branch->name] = $salesByBranch[$branch->id] ?? 0;
        }

        // Ambil transaksi terbaru
        $recentTransactions = Transaction::with('user', 'details.product')
                                ->orderBy('transaction_date', 'desc')
                                ->take(5)
                                ->get();

        return view('dashboard', compact('totalBranches', 'totalProducts','totalStock', 'totalSales', 'salesByBranch', 'salesByBranchData', 'recentTransactions'));
    }
}
