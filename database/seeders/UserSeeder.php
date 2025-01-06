<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Owner -> Pak Jayusman
        User::create([
            'name' => 'Jayusman',
            'email' => 'jayusman@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'role' => 'Owner',
        ])->assignRole('Owner')->givePermissionTo(Permission::all());
    }
}
