<?php

namespace Database\Seeders;

use App\Models\Transaction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Transaction::create([
            'transaction_date'=> now(),
            'user_id'=> 1,
            'branch_id'=> 1,
            'total_price'=> 10000,
           
        ]);

        Transaction::create([
            'transaction_date'=> now(),
            'user_id'=> 1,
            'branch_id'=> 1,
            'total_price'=> 20000,
        ]);

        Transaction::create([
            'transaction_date'=> now(),
            'user_id'=> 1,
            'branch_id'=> 1,
            'total_price'=> 30000,
        ]);
    }
}
