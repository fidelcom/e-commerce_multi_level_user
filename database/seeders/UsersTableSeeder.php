<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            //admin
            [
                'name' => 'Admin',
                'username' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'status' => 'active',

            ],
            //Vendor
            [
                'name' => 'Vendor',
                'username' => 'vendor',
                'email' => 'vendor@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'vendor',
                'status' => 'active',

            ],
            //Sub-admin
            [
                'name' => 'Subadmin',
                'username' => 'subadmin',
                'email' => 'subadmin@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'subadmin',
                'status' => 'active',

            ],
            //Analyst
            [
                'name' => 'Analyst',
                'username' => 'analyst',
                'email' => 'analyst@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'analyst',
                'status' => 'active',

            ],
            //User
            [
                'name' => 'User',
                'username' => 'user',
                'email' => 'user@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'user',
                'status' => 'active',
            ],
        ]);
    }
}
