<div class="min-w-full">
    <div class="flex flex-row justify-between items-center">
        <flux:heading sile="xl">{{ $quiz->name }}</flux:heading>
        <livewire:quiz.update-quiz-modal :$quiz />
    </div>

    <flux:text class="mb-5">
        {{ $quiz->description }}
    </flux:text>

    <flux:text>{{ $this->flashcards->count() }} Karten</flux:text>

    <flux:separator class="my-5" />

    <div>
        @foreach($this->flashcards as $flashcard)
            {{-- flashcard --}}
        @endforeach
    </div>
</div>
