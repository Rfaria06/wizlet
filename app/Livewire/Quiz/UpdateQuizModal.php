<?php

namespace App\Livewire\Quiz;

use App\Models\Quiz;
use Flux;
use Livewire\Attributes\Validate;
use Livewire\Component;

class UpdateQuizModal extends Component
{
    public Quiz $quiz;

    #[Validate("string|required|min:3|max:255")]
    public string $name = "";

    #[Validate("sometimes|string|nullable")]
    public string $description = "";

    #[Validate("boolean|required")]
    public bool $public = true;

    public function save()
    {
        $this->quiz->update($this->only("name", "description", "public"));

        Flux::toast("Quiz aktualisiert", variant: "success");
        $this->redirectRoute("quiz.show", ["quiz" => $this->quiz]);
    }

    public function mount(Quiz $quiz)
    {
        $this->fill($quiz->only("name", "description", "public"));
    }

    public function render()
    {
        return view("livewire.quiz.update-quiz-modal");
    }
}
