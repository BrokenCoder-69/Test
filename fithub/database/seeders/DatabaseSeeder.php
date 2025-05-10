<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call(GymSeeder::class);

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'qwer',
            'status' => 'approved',
            'role' => 'user'
        ]);
        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => 'admin12345',
            'status' => 'approved',
            'role' => 'admin'
        ]);
        User::factory()->create([
            'name' => 'trainer1',
            'email' => 'trainer1@example.com',
            'password' => '123456',
            'status' => 'approved',
            'role' => 'trainer'
        ]);
        User::factory()->create([
            'name' => 'trainer2',
            'email' => 'trainer2@example.com',
            'password' => '123456',
            'status' => 'approved',
            'role' => 'trainer'
        ]);
    }
}
