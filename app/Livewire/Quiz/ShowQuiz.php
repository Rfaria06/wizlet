<?php

namespace App\Livewire\Quiz;

use App\Models\Quiz;
use Flux;
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
        return $this->quiz
            ->flashcards()
            ->orderBy('id', 'desc')
            ->get();
    }

    public function delete()
    {
        if (! $this->quiz->user()->is(auth()->user())) {
            abort(403);
        }

        $this->quiz->delete();
        Flux::toast('Quiz gelöscht');
        $this->redirectRoute('quiz.list', navigate: false);
    }

    public function render()
    {
        return view('livewire.quiz.show-quiz');
    }
}
