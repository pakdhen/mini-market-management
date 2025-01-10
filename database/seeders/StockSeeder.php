<?php

namespace Database\Seeders;

use App\Models\Stock;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Stock::create([
            'product_id' => 1,
            'branch_id' => 1,
            'quantity' => 50,
        ]);

        Stock::create([
           'product_id' => 2,
            'branch_id' => 2,
            'quantity' => 60,
        ]);

        Stock::create([
            'product_id' => 3,
            'branch_id' => 3,
            'quantity' => 70,
        ]);
    }
}
