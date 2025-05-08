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

        User::factory()->create([
            'name' => 'test',
            'surname' => 'test',
            'age' => '25',
            'email' => 'test@test.com',
            'password' => 'test1234',
        ]);

        User::factory()->create([
            'name' => 'test2',
            'surname' => 'test2',
            'age' => '30',
            'email' => 'test2@test2.com',
            'password' => 'test1234',
        ]);

        User::factory()->create([
            'name' => 'test3',
            'surname' => 'test3',
            'age' => '37',
            'email' => 'test3@test3.com',
            'password' => 'test1234',
        ]);
    }
}
