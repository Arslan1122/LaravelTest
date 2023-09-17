<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //disable the foreign key check to avoid foreign key constraint error
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('roles')->truncate();

        $names = ['admin', 'b2c_customer', 'b2b_customer'];

        for ($i = 0; $i < sizeof($names); $i++)
        {
            Role::create(['name' => $names[$i]]);
        }

        //enable the foreign key check again.
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
