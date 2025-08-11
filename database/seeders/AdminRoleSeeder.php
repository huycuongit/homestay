<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;
use App\Models\Admin;
use App\Models\Department;

class AdminRoleSeeder extends Seeder
{
    public function run()
    {
        // Create Admin
        $admin1 = Admin::updateOrInsert(
            ['email' => 'admin@homestay.com'],
            [
                'name' => 'Quản Trị Viên',
                'user_name' => 'Admin',
                'password' => Hash::make('Homestay@123'),
                'type' => 1,
                'status' => 1,
                'no_remove' => true,
                'created_at' => now(),
                'updated_at' => now()
            ]
        );


        // Get roles Admin and HR
        $adminRole = Role::where('name_key', 'ADMIN')->first();
        // Get ID of Admin and HR just created
        $admin = Admin::where('email', 'admin@homestay.com')->first();
        // Swap role for account
        $admin->roles()->sync(
            ['role_id' => $adminRole->id]
        );
    }
}
