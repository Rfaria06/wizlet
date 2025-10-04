<?php

namespace App\Livewire\Quiz;

use Flux;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CreateQuizModal extends Component
{
    #[Validate('string|required|min:3|max:255')]
    public string $name = '';

    #[Validate('sometimes|string|nullable')]
    public string $description = '';

    #[Validate('boolean|required')]
    public bool $public = true;

    public function save(): void
    {
        $quiz = auth()
            ->user()
            ->quizzes()
            ->create([
                'name' => $this->name,
                'description' => $this->description,
                'public' => $this->public,
            ]);

        Flux::toast('Quiz erstellt', variant: 'success');
        $this->redirectRoute('quiz.show', ['quiz' => $quiz], navigate: true);
    }

    public function render()
    {
        return view('livewire.quiz.create-quiz-modal');
    }
}
