<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $fillable = [
        'product_id',
        'branch_id',
        'quantity',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke produk yang ada di stok ini.
     */
    public function product()
    {
        // Setiap stok berhubungan dengan satu produk
        return $this->belongsTo(Product::class);
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
