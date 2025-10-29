<?php

namespace App\Livewire\Quiz;

use App\Models\Quiz;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class QuizList extends Component
{
    use WithPagination;

    public string $search = "";

    public bool $onlyOwned = false;

    #[Computed]
    public function quizzes()
    {
        $search = trim($this->search);
        $query = Quiz::query();

        if ($this->onlyOwned) {
            $query->where('user_id', auth()->id());
        }

        $query->where(function ($q) {
            $q->where('public', true)
                ->orWhere('user_id', auth()->id());
        });

        if ($search !== '') {
            $query->where('name', 'like', "%{$search}%");
        }

        return $query->orderByDesc('created_at')->paginate(8);
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedOnlyOwned()
    {
        $this->resetPage();
    }



    public function render()
    {
        return view("livewire.quiz.quiz-list");
    }
}
