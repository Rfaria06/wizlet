<div class="min-w-full">
    <div class="flex flex-row justify-between items-center">
        <flux:heading sile="xl">{{ $quiz->name }}</flux:heading>
        @can('update', $quiz)
            <div class="flex flex-row gap-1 justify-around">
                <livewire:quiz.update-quiz-modal :$quiz />
                <flux:button
                    variant="danger"
                    icon-trailing="trash"
                    wire:click="delete"
                    wire:confirm="Sind sie sicher, dass sie dieses Quiz löschen möchten?"
                ></flux:button>
            </div>
        @endcan
    </div>

    <div class="flex flex-col gap-4">
        <flux:text>{{ $quiz->user->name }}</flux:text>

        <flux:text class="max-w-lg">
            {{ $quiz->description }}
        </flux:text>

        <flux:text>{{ $this->flashcards->count() }} Karten</flux:text>

        <flux:text>{{ $quiz->public ? 'Öffentlich' : 'Privat' }}</flux:text>
    </div>

    <flux:separator class="my-5" />

    @can('update', $quiz)
    <div class="flex flex-row items-center gap-2">
        <livewire:flashcard.create-flashcard-modal :quizId="$quiz->id" />
        <livewire:quiz.generate-flashcards-modal :$quiz />
    </div>
    @endcan

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 my-5">
        @foreach ($this->flashcards as $flashcard)
            <div wire:model="{{ $flashcard->id }}">
                <livewire:flashcard.flashcard-display :$flashcard />
                @can('update', $flashcard)
                    <div class="flex flex-row items-center gap-2 mt-2">
                        <livewire:flashcard.edit-flashcard :$flashcard />
                        <flux:button
                            variant="danger"
                            icon-trailing="trash"
                            wire:click="deleteFlashcard({{ $flashcard->id }})"
                            wire:confirm="Sind sie sicher, dass sie diese Karte löschen möchten?"
                        ></flux:button>
                    </div>
                @endcan
            </div>
        @endforeach
    </div>
</div>
