<?php

namespace App\Jobs;

use App\Models\Flashcard;
use App\Models\Quiz;
use App\Models\User;
use App\Services\OpenAIService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use InvalidArgumentException;

class CreateFlashcards implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public readonly User $user,
        public readonly string $userPrompt,
        public readonly Quiz $quiz
    ) {
    }

    /**
     * Execute the job.
     */
    public function handle(OpenAIService $service): void
    {
        if ($this->user->cant("update", $this->quiz)) {
            throw new InvalidArgumentException(
                "User " .
                    $this->user->email .
                    " can not update quiz " .
                    $this->quiz->id
            );
        }

        $flashcards = $service->createFlashcards($this->userPrompt);

        $flashcards->each(function (Flashcard $flashcard) {
            $flashcard->quiz_id = $this->quiz->id;
            $flashcard->save();
        });
    }
}
