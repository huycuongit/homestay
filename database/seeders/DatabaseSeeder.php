<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Create databases first
         */
        $this->call(RolePermissionSeeder::class);
        $this->call(AdminRoleSeeder::class);

        $this->call(SettingSeeder::class);
        // $this->call(BranchesTableSeeder::class);
    }
}
