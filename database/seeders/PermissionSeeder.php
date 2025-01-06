<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //User Management
        Permission::create(['name' => 'view_users']);
        Permission::create(['name' => 'edit_users']); //create, delete, update

        // //Role Management
        // Permission::create(['name' => 'view_roles']);

        //Product Management
        Permission::create(['name' => 'view_products']);
        Permission::create(['name' => 'edit_products']); //create, delete, update

        //Stock Management
        Permission::create(['name' => 'view_stocks']);
        Permission::create(['name' => 'edit_stocks']); //update

        //Transaction Management
        Permission::create(['name' => 'view_transactions']);
        Permission::create(['name' => 'edit_transactions']); //create, delete, update

        //Report Management
        Permission::create(['name' => 'view_reports']);
        Permission::create(['name' => 'generate_reports']); //export
    }
}
