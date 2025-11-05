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
        User::updateOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Admin',
                'password' => bcrypt('admin'),
                'role' => 'admin',
            ]
        );

        User::updateOrCreate(
            ['email' => 'driver1@transin.com'],
            [
                'name' => 'Driver1',
                'password' => bcrypt('password'),
                'role' => 'driver',
            ]
        );

        User::updateOrCreate(
            ['email' => 'driver2@transin.com'],
            [
                'name' => 'Driver2',
                'password' => bcrypt('password'),
                'role' => 'driver',
            ]
        );

        User::updateOrCreate(
            ['email' => 'driver3@transin.com'],
            [
                'name' => 'Driver3',
                'password' => bcrypt('password'),
                'role' => 'driver',
            ]
        );
    }
}
