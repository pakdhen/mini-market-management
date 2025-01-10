<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_date',
        'user_id',
        'branch_id',
        'total_price',
    ];

    protected $casts = [
        'transaction_date' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke cabang yang memiliki stok ini.
     */
    public function branch()
    {
        // Setiap stok berhubungan dengan satu cabang
        return $this->belongsTo(Branch::class);
    }

    public function details()
    {
        return $this->hasMany(TransactionDetail::class);
    }
}
