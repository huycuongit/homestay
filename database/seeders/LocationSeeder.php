<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\File;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('provinces')->truncate();

        // DB::table('wards')->truncate();

        $sql1 = base_path('database/sql/provinces.sql');
        $sql2 = base_path('database/sql/wards.sql');

        // Check if the file exists
        if (File::exists($sql1)) {
            // Get the contents of the SQL file
            $sqlContent = File::get($sql1);

            // Execute the SQL script
            DB::unprepared($sqlContent);

        } else {
            echo "SQL provinces file does not exist.";
        }
        if (File::exists($sql2)) {
            // Get the contents of the SQL file
            $sqlContent = File::get($sql2);

            // Execute the SQL script
            DB::unprepared($sqlContent);

        } else {
            echo "SQL provinces file does not exist.";
        }
    }
}
