<?php

namespace Database\Seeders;

use App\Models\Gym;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GymSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $gyms = [
            [
                'name' => 'Iron Gym',
                'address' => '123 Main St, Dhaka',
                'latitude' => 23.8103,
                'longitude' => 90.4125,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Muscle Factory',
                'address' => '456 Fitness Ave, Dhaka',
                'latitude' => 23.8598,
                'longitude' => 90.4662,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Powerhouse Gym',
                'address' => '789 Strength Rd, Dhaka',
                'latitude' => 23.9093,
                'longitude' => 90.5199,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'FitZone',
                'address' => '101 Healthy Blvd, Dhaka',
                'latitude' => 23.9588,
                'longitude' => 90.5736,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Elite Fitness',
                'address' => '202 Workout Ln, Dhaka',
                'latitude' => 24.0083,
                'longitude' => 90.6273,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'ZooFit Gym',
                'address' => 'Zoo Road, Mirpur, Dhaka',
                'latitude' => 23.8125,
                'longitude' => 90.3530,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Animal Strength Center',
                'address' => 'Mirpur-1, Dhaka',
                'latitude' => 23.8140,
                'longitude' => 90.3590,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Safari Fitness Club',
                'address' => 'Kazipara, Mirpur, Dhaka',
                'latitude' => 23.8180,
                'longitude' => 90.3645,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Beast Mode Gym',
                'address' => 'Shewrapara, Mirpur, Dhaka',
                'latitude' => 23.8220,
                'longitude' => 90.3690,
                'created_at' => now(),
                'updated_at' => now(),
            ]

        ];
        


        DB::table('gyms')->insert($gyms);
    }
}