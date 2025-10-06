<?php

namespace App\Livewire\Quiz;

use App\Models\Quiz;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class QuizList extends Component
{
    use WithPagination;

    #[Computed]
    public function quizzes()
    {
        return Quiz::query()
            ->where("public", true)
            ->orWhere("user_id", auth()->id())
            ->orderBy("created_at", "desc")
            ->paginate(8);
    }

    public function render()
    {
        return view("livewire.quiz.quiz-list");
    }
}
