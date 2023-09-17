<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Create users and assign roles
     */
    public function run(): void
    {

        //create users
         $user = User::create([
             'name' => "Admin",
             "email" => "admin@store.com",
             "password" => Hash::make('password'),
             "email_verified_at" => Carbon::now()
         ]);

         //assign admin role
         $user->assignRole('admin');

    }
}
