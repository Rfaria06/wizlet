<?php

namespace App\Livewire\Flashcard;

use App\Models\Flashcard;
use Livewire\Attributes\Validate;
use Livewire\Component;

class EditFlashcard extends Component
{
    public Flashcard $flashcard;

    #[Validate('string|required|max:255')]
    public string $question = '';

    #[Validate('string|required|max:255')]
    public string $answer = '';

    public function save(): void
    {
        $this->validate();

        if (
            ! $this->flashcard ||
            $this->flashcard->quiz->user_id !== auth()->id()
        ) {
            abort(403);
        }

        $this->flashcard->update([
            'question' => $this->question,
            'answer' => $this->answer,
        ]);

        $this->redirectRoute(
            'quiz.show',
            ['quiz' => $this->flashcard->quiz_id],
            navigate: true
        );
    }

    public function mount(Flashcard $flashcard): void
    {
        $this->flashcard = $flashcard;
        $this->question = $flashcard->question;
        $this->answer = $flashcard->answer;
    }

    public function render()
    {
        return view('livewire.flashcard.edit-flashcard');
    }
}
