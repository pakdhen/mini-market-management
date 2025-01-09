<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Models\Transaction;

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
});

Route::group(['middleware' => ['role:Owner']], function () {
    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::get('/branches', [BranchController::class, 'index'])->name('branches');
});

Route::middleware(['auth', 'role:Owner|Manager|Supervisor|Kasir'])->group(function () {
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions');
});

require __DIR__ . '/auth.php';
