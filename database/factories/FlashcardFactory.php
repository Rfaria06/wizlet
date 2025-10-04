<?php

namespace Database\Factories;

use App\Models\Quiz;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Flashcard>
 */
class FlashcardFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'question' => $this->makeQuestion(),
            'answer' => $this->faker->sentence(),
            'quiz_id' => Quiz::factory(),
        ];
    }

    private function makeQuestion(): string
    {
        $questions = collect([
            fn () => "What is the capital of {$this->faker->country()}?",
            fn () => "Which animal is known as '{$this->faker->word()}'?",
            fn () => "Who wrote the book '{$this->faker->sentence(3)}'?",
            fn () => "In what year did {$this->faker->name()} supposedly discover {$this->faker->word()}?",
            fn () => "What is the chemical symbol for {$this->faker->word()}?",
            fn () => "How many {$this->faker->words(
                2,
                true
            )} are in a {$this->faker->word()}?",
            fn () => "Which planet is closest to {$this->faker->company()}?",
            fn () => "What language is spoken in {$this->faker->city()}?",
            fn () => "What is the currency of {$this->faker->country()}?",
            fn () => "Who is the founder of {$this->faker->company()}?",
        ]);

        return $questions->random()();
    }
}
