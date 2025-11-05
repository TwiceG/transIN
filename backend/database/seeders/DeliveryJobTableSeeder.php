<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DeliveryJob;

class DeliveryJobTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DeliveryJob::insert([
            [
                'starting_address' => '123 Main Street, Cityville',
                'destination_address' => '456 Elm Avenue, Townsville',
                'recipient_name' => 'John Doe',
                'recipient_phone' => '555-1234',
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'starting_address' => '789 Oak Road, Metro City',
                'destination_address' => '12 Pine Street, Riverdale',
                'recipient_name' => 'Jane Smith',
                'recipient_phone' => '555-5678',
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'starting_address' => '42 Maple Lane, Seaside',
                'destination_address' => '88 Birch Blvd, Lakeside',
                'recipient_name' => 'Bob Johnson',
                'recipient_phone' => '555-9999',
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
