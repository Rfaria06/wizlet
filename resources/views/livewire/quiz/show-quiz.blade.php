<div class="min-w-full">
    <div class="flex flex-row justify-between items-center">
        <flux:heading sile="xl">{{ $quiz->name }}</flux:heading>
        <div class="flex flex-row gap-1 justify-around">
        <livewire:quiz.update-quiz-modal :$quiz />
        <flux:button variant="danger" icon-trailing="trash" wire:click="delete" wire:confirm="Sind sie sicher, dass sie dieses Quiz löschen möchten?"></flux:button>
        </div>
    </div>

    <div class="flex flex-col gap-4">
        <flux:text>
            {{ $quiz->description }}
        </flux:text>

        <flux:text>{{ $this->flashcards->count() }} Karten</flux:text>

        <flux:text>{{ $quiz->public ? 'Öffentlich' : 'Privat' }}</flux:text>
    </div>

    <flux:separator class="my-5" />

    <div>
        @foreach ($this->flashcards as $flashcard)
            {{-- flashcard --}}
        @endforeach
    </div>
</div>
