<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            ['name' => 'Alice', 'email' => 'alice@example.com'],
            ['name' => 'Bob', 'email' => 'bob@example.com'],
            ['name' => 'Charlie', 'email' => 'charlie@example.com'],
            ['name' => 'David', 'email' => 'david@example.com'],
            ['name' => 'Eve', 'email' => 'eve@example.com'],
            ['name' => 'Frank', 'email' => 'frank@example.com'],
            ['name' => 'Grace', 'email' => 'grace@example.com'],
            ['name' => 'Hannah', 'email' => 'hannah@example.com'],
            ['name' => 'Ivy', 'email' => 'ivy@example.com'],
            ['name' => 'Jack', 'email' => 'jack@example.com'],
            ['name' => 'Kathy', 'email' => 'kathy@example.com'],
            ['name' => 'Leo', 'email' => 'leo@example.com'],
            ['name' => 'Mona', 'email' => 'mona@example.com'],
        ];

        foreach ($users as $user) {
            User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => Hash::make('vitou123'), // Password for all users
                'score' => rand(0, 100), // Random score between 0 and 100
                'remember_token' => Str::random(10),
            ]);
        }
    }
}
