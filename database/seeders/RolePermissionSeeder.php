<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;
use App\Models\Department;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        // Create Permissions
        $permissions = config('permissions');

        foreach ($permissions as $module => $moduleData) {
            foreach ($moduleData['routes'] as $method => $permission) {
                Permission::updateOrCreate(
                    ['route' => $permission['route']],
                    [
                        'module' => $module,
                        'module_name' => $moduleData['module_name'],
                        'method' => $method,
                        'method_name' => $permission['method_name'],
                        'route' => $permission['route']
                    ]
                );
            }
        }

        // Create Roles
        $adminRole = Role::updateOrCreate(
            ['name_key' => 'ADMIN'],
            [
                'name' => 'Admin',
                'is_full_permission' => 1,
                'active' => 1,
                'position' => 1,
            ]
        );

        $hrRole = Role::updateOrCreate(
            ['name_key' => 'CUSTOMER'],
            [
                'name' => 'ADMIN CUSTOMER',
                'is_full_permission' => 0,
                'active' => 1,
                'position' => 2,
            ]
        );

        // Permissions for Admin
        $allPermissions = Permission::all();
        $adminRole->permissions()->sync(
            $allPermissions->pluck('id')->toArray()
        );

        // Permissions for Member shareholder
        $hrPermissions = Permission::whereIn('module', ['branchs', 'dashboard'])->get();
        $hrRole->permissions()->sync(
            $hrPermissions->pluck('id')->toArray()
        );
    }
}
