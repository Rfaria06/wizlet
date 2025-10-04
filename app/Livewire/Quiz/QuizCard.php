<?php

namespace App\Livewire\Quiz;

use App\Models\Quiz;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Str;

class QuizCard extends Component
{
    public Quiz $quiz;

    #[Computed]
    public function description(): string
    {
        return Str::of($this->quiz->description)->limit(80);
    }

    public function render()
    {
        return view("livewire.quiz.quiz-card");
    }
}
