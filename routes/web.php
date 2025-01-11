<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Models\Transaction;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/products', [ProductController::class, 'index'])->name('products');
    Route::get('/stocks', [StockController::class, 'index'])->name('stocks');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::group(['middleware' => ['role:Owner']], function () {
    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::get('/branches', [BranchController::class, 'index'])->name('branches');
    Route::get('/branches/{branch}', [BranchController::class, 'show'])->name('branches.show');
    Route::resource('users', UserController::class);
});

Route::middleware(['auth', 'role:Owner|Manager|Supervisor|Kasir'])->group(function () {
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions');
});

Route::middleware(['auth', 'role:Owner|Manager|'])->group(function () {
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::patch('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
});
Route::middleware(['auth', 'role:Manager|PegawaiGudang'])->group(function () {
    Route::get('/stocks/create', [StockController::class, 'create'])->name('stocks.create');
    Route::post('/stocks/store', [StockController::class, 'store'])->name('stocks.store');
    Route::get('/stocks/{stock}/edit', [StockController::class, 'edit'])->name('stocks.edit');
    Route::patch('/stocks/{stock}', [StockController::class, 'update'])->name('stocks.update');
    Route::delete('/stocks/{stock}', [StockController::class, 'destroy'])->name('stocks.destroy');
});
require __DIR__ . '/auth.php';
