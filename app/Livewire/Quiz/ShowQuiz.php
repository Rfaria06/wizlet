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
            ->orderBy("id", "desc")
            ->get();
    }

    public function delete()
    {
        if (!$this->isOwner()) {
            abort(403);
        }

        $this->quiz->delete();
        Flux::toast("Quiz gelöscht");
        $this->redirectRoute("quiz.list", navigate: false);
    }

    public function isOwner(): bool
    {
        return $this->quiz->user()->is(auth()->user());
    }

    public function deleteFlashcard(int $flashcardId): void
    {
        if (!$this->isOwner()) {
            abort(403);
        }

        $this->quiz
            ->flashcards()
            ->whereId($flashcardId)
            ->delete();
        $this->redirectRoute(
            "quiz.show",
            ["quiz" => $this->quiz],
            navigate: true
        );
    }

    public function render()
    {
        return view("livewire.quiz.show-quiz");
    }
}
