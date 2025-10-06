<?php

namespace App\Livewire\Quiz;

use App\Jobs\CreateFlashcards;
use App\Models\Quiz;
use Flux;
use Livewire\Attributes\Validate;
use Livewire\Component;

class GenerateFlashcardsModal extends Component
{
    public Quiz $quiz;

    #[Validate("string|required|min:10")]
    public string $prompt = "";

    public function generate(): void
    {
        if (
            !$this->quiz ||
            auth()
                ->user()
                ->cant("update", $this->quiz)
        ) {
            abort(403);
        }
        $this->validate();

        CreateFlashcards::dispatch(auth()->user(), $this->prompt, $this->quiz);
        Flux::modals()->close();
        Flux::toast(
            "Check back in a few moments to see the generated flashcards",
            variant: "success",
            heading: "Generation started!",
            duration: 0 // indefinetely
        );
    }

    public function mount(Quiz $quiz): void
    {
        $this->quiz = $quiz;
    }

    public function render()
    {
        return view("livewire.quiz.generate-flashcards-modal");
    }
}
