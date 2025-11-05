<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Vehicle;

class VehicleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Vehicle::insert([
            [
                'brand' => 'Toyota',
                'type' => 'Van',
                'license_plate' => 'ABC-1234',
                'user_id' => 2,
            ],
            [
                'brand' => 'Ford',
                'type' => 'Truck',
                'license_plate' => 'XYZ-5678',
                'user_id' => 3,
            ],
            [
                'brand' => 'Honda',
                'type' => 'Car',
                'license_plate' => 'HND-8765',
                'user_id' => 4,
            ],
        ]);
    }
}
