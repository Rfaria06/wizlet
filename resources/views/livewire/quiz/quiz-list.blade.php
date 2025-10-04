@php
    use App\Models\Quiz;
@endphp

<div>
    <div>
        <livewire:quiz.create-quiz-modal />

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 my-5">
            @foreach ($this->quizzes as $quiz)
                <livewire:quiz.quiz-card :$quiz wire:key="{{ $quiz->id }}" />
            @endforeach
        </div>
    </div>
</div>
