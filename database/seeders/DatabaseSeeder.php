<?php

namespace Database\Seeders;

use App\Models\Flashcard;
use App\Models\Quiz;
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
        if (! app()->isProduction()) {
            User::factory()
                ->count(10)
                ->has(
                    Quiz::factory()
                        ->count(10)
                        ->has(Flashcard::factory()->count(15))
                )
                ->create();

            User::factory([
                'name' => 'Test User',
                'email' => 'test@example.com',
                'password' => '12345678',
            ])
                ->has(
                    Quiz::factory()
                        ->count(10)
                        ->has(Flashcard::factory()->count(15))
                )
                ->create();
        }
    }
}
