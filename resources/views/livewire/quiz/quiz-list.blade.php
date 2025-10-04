<div>
    <div>
        <flux:heading size="xl">{{ __('Quizze') }}</flux:heading>
        <flux:separator class="mb-5" />

<div class="flex flex-wrap flex-row gap-4">
        @foreach ($this->quizzes as $quiz)
            <livewire:quiz.quiz-card :$quiz />
        @endforeach
</div>
    </div>
</div>
