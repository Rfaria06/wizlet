<div class="min-w-full">
    <div class="flex flex-row justify-between items-center">
        <flux:heading sile="xl">{{ $quiz->name }}</flux:heading>
        <livewire:quiz.modify-quiz-modal :$quiz />
    </div>

    <flux:separator class="my-5" />

    <div>
        @foreach($this->flashcards as $flashcard)
            {{-- flashcard --}}
        @endforeach
    </div>
</div>
