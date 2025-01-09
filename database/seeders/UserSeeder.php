<?php

namespace Database\Seeders;

use App\Models\Branch;
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
        ])->assignRole('Owner')->givePermissionTo(Permission::all());

        // Menambahkan 5 cabang
        $branches = Branch::all();

        foreach ($branches as $branch) {
            // Manager
            $manager = User::create([
                'name' => 'Manager ' . $branch->name,
                'email' => 'manager' . $branch->id .'@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'branch_id' => $branch->id,
            ]);
            $manager->assignRole('Manager')->givePermissionTo('view_users', 'view_products', 'edit_products', 'view_stocks', 'edit_stocks', 'view_transactions', 
                                                              'edit_transactions', 'view_reports', 'generate_reports');

            // Supervisor
            $supervisor = User::create([
                'name' => 'Supervisor ' . $branch->name,
                'email' => 'supervisor' . $branch->id .'@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'branch_id' => $branch->id,
            ]);
            $supervisor->assignRole('Supervisor')->givePermissionTo('view_users', 'view_products', 'edit_products', 'view_stocks', 'edit_stocks', 'view_transactions', 
                                                                    'view_reports', 'generate_reports');;

            // Kasir
            $kasir = User::create([
                'name' => 'Kasir ' . $branch->name,
                'email' => 'kasir' . $branch->id .'@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'branch_id' => $branch->id,
            ]);
            $kasir->assignRole('Kasir')->givePermissionTo('view_transactions', 'edit_transactions', 'view_products', 'view_stocks');

            // Pegawai Gudang
            $gudang = User::create([
                'name' => 'Pegawai Gudang ' . $branch->name,
                'email' => 'pegawaiGudang' . $branch->id .'@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'branch_id' => $branch->id,
            ]);
            $gudang->assignRole('PegawaiGudang')->givePermissionTo('view_stocks', 'edit_stocks', 'view_products');
        }
    }
}
