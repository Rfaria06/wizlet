<?php

namespace App\Livewire\Quiz;

use App\Models\Quiz;
use Livewire\Attributes\Computed;
use Livewire\Component;

class QuizList extends Component
{
    #[Computed]
    public function quizzes()
    {
        return Quiz::query()
            ->orderBy('created_at', 'desc')
            ->paginate();
    }

    public function render()
    {
        return view('livewire.quiz.quiz-list');
    }
}
