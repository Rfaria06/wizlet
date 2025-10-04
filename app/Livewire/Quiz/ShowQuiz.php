<?php

namespace App\Livewire\Quiz;

use App\Models\Quiz;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Locked;
use Livewire\Component;

class ShowQuiz extends Component
{
    #[Locked]
    public Quiz $quiz;

    #[Computed]
    public function flashcards()
    {
        return $this->quiz->flashcards()->paginate();
    }

    public function render()
    {
        return view("livewire.quiz.show-quiz");
    }
}
