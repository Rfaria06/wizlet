<?php

namespace App\Livewire\Flashcard;

use App\Models\Flashcard;
use Flux;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CreateFlashcardModal extends Component
{
    #[Validate('string|required')]
    public string $question = '';

    #[Validate('string|required')]
    public string $answer = '';

    public int $quizId = 0;

    public function save(): void
    {
        Flashcard::create([
            'question' => $this->question,
            'answer' => $this->answer,
            'quiz_id' => $this->quizId,
        ]);

        Flux::toast('Erstellt');
        $this->reset('question', 'answer');
    }

    public function render()
    {
        return view('livewire.flashcard.create-flashcard-modal');
    }
}
