<?php

namespace App\Livewire\Quiz;

use App\Models\Flashcard;
use App\Models\Quiz;
use Illuminate\Support\Collection;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Url;
use Livewire\Component;

class Learn extends Component
{
    #[Locked]
    public Quiz $quiz;

    #[Url]
    public int $flashcardIndex = 0;

    public Collection $flashcards;

    public function mount(): void
    {
        $this->flashcards = $this->quiz->flashcards;
    }

    public function next(): void
    {
        if ($this->flashcardIndex < $this->flashcards->count()) {
            $this->flashcardIndex++;
        }
    }

    public function previous(): void
    {
        if ($this->flashcardIndex > 0) {
            $this->flashcardIndex--;
        }
    }

    public function render()
    {
        return view('livewire.quiz.learn');
    }
}
