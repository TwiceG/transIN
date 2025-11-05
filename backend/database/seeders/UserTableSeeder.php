<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            [
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'password' => bcrypt('admin'),
                'role' => 'admin',
            ],
            [
                'name' => 'Driver1',
                'email' => 'driver1@transin.com',
                'password' => bcrypt('password'),
                'role' => 'driver',
            ],
            [
                'name' => 'Driver2',
                'email' => 'driver2@transin.com',
                'password' => bcrypt('password'),
                'role' => 'driver',
            ],
            [
                'name' => 'Driver3',
                'email' => 'driver3@transin.com',
                'password' => bcrypt('password'),
                'role' => 'driver',
            ],
        ]);
    }
}
