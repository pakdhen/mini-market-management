<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

abstract class Controller extends BaseController
{
    // Menggunakan trait untuk mengotorisasi dan memvalidasi permintaan
    use AuthorizesRequests, ValidatesRequests;

    /**
     * Konstruktor untuk controller ini.
     * Middleware dapat ditambahkan di sini untuk mengatur akses dan otentikasi.
     */
    public function __construct()
    {
        // Pastikan semua pengguna harus login untuk mengakses controller turunan ini
        $this->middleware('auth');

        // Middleware tambahan untuk membatasi akses berdasarkan peran (contoh: hanya manager)
        $this->middleware('role:manager')->only(['create', 'store', 'edit', 'update', 'destroy']);
    }

    /**
     * Cek apakah pengguna memiliki peran tertentu.
     *
     * @param string $role
     * @return void
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     */
    protected function checkRole(string $role): void
    {
        // Periksa apakah pengguna memiliki peran yang diminta
        if (!auth()->user()->hasRole($role)) {
            abort(403, 'Akses ditolak: Anda tidak memiliki izin untuk melakukan tindakan ini.');
        }
    }
}
