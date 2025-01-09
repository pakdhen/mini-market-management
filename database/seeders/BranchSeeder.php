<?php

namespace Database\Seeders;

use App\Models\Branch;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Branch::create([
            'name' => 'Cabang 1',
            'address' => 'Jl. Merdeka No. 1, Jakarta',
        ]);

        Branch::create([
            'name' => 'Cabang 2',
            'address' => 'Jl. Pahlawan No. 2, Bandung',
        ]);

        Branch::create([
            'name' => 'Cabang 3',
            'address' => 'Jl. Sejahtera No. 3, Cianjur',
        ]);

        Branch::create([
            'name' => 'Cabang 4',
            'address' => 'Jl. Raya No. 4, Surabaya',
        ]);

        Branch::create([
            'name' => 'Cabang 5',
            'address' => 'Jl. Kenangan No. 5, Solo',
        ]);
    }
}
