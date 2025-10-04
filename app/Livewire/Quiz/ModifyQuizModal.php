<?php

namespace App\Livewire\Quiz;

use App\Models\Quiz;
use Flux;
use Livewire\Component;

class ModifyQuizModal extends Component
{
    public string $name = "";

    public string $description = "";

    public bool $public = true;

    private Quiz $quiz;

    public function __construct()
    {
        $this->quiz = new Quiz();
    }

    public function save(): void
    {
        if ($this->quiz->exists) {
            $this->quiz->update([
                "name" => $this->name,
                "description" => $this->description,
                "public" => $this->public,
            ]);

            Flux::toast("Quiz aktualisiert", variant: "success");
        } else {
            $quiz = auth()
                ->user()
                ->quizzes()
                ->create([
                    "name" => $this->name,
                    "description" => $this->description,
                    "public" => $this->public,
                ]);

            Flux::toast("Quiz erstellt", variant: "success");
        }
    }

    public function mount(Quiz $quiz): void
    {
        $this->quiz = $quiz;
        $this->name = $quiz->name ?? "";
        $this->description = $quiz->description ?? "";
        $this->public = $quiz->public ?? true;
    }

    public function render()
    {
        return view("livewire.quiz.modify-quiz-modal");
    }
}
