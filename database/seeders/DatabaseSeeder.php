<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\Product;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Admin User',
        //     'email' => 'ramadhan@gmail.com',
        //     'password' => bcrypt('password'),
        // ]);
        $this->call([
            RoleSeeder::class,
            PermissionSeeder::class,
            UserSeeder::class,
            StockSeeder::class,
            ProductSeeder::class,
            BranchSeeder::class,
        ]);
    }
}
