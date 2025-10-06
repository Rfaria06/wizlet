<?php

namespace App\Livewire\Flashcard;

use App\Models\Flashcard;
use Flux;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CreateFlashcardModal extends Component
{
    #[Validate("string|required|max:255")]
    public string $question = "";

    #[Validate("string|required|max:255")]
    public string $answer = "";

    public int $quizId = 0;

    public function save(): void
    {
        $this->validate();

        Flashcard::create([
            "question" => $this->question,
            "answer" => $this->answer,
            "quiz_id" => $this->quizId,
        ]);

        Flux::toast("Erstellt");
        $this->reset("question", "answer");
        $this->redirectRoute(
            "quiz.show",
            ["quiz" => $this->quizId],
            navigate: true
        );
    }

    public function render()
    {
        return view("livewire.flashcard.create-flashcard-modal");
    }
}
