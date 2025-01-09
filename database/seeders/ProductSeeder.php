<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'name' => 'Product 1',
            'price' => 10000,
        ]);

        Product::create([
            'name' => 'Product 2',
            'price' => 20000,
        ]);

        Product::create([
            'name' => 'Product 3',
            'price' => 30000,
        ]);
    }
}