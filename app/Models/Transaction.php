<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'transaction_date',
        'user_id',
        'branch_id',
        'total_price',
    ];

    /**
     * Relasi ke produk yang ada di stok ini.
     */
    public function transaction()
    {
        // Setiap stok berhubungan dengan satu produk
        return $this->belongsTo(transaction::class);
    }

    /**
     * Relasi ke cabang yang memiliki stok ini.
     */
    public function branch()
    {
        // Setiap stok berhubungan dengan satu cabang
        return $this->belongsTo(Branch::class);
    }
}
