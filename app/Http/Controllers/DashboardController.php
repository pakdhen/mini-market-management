<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Product;
use App\Models\Sale;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBranches = Branch::count();
        $totalSales = Sale::sum('amount');
        $totalStock = Product::sum('stock');
        $salesByMonth = Sale::selectRaw('MONTH(created_at) as month, SUM(amount) as total')
                            ->groupBy('month')
                            ->pluck('total', 'month');

        return view('dashboard', compact('totalBranches', 'totalSales', 'totalStock', 'salesByMonth'));
    }
}
