<div>
    <div class="mb-5">
        <flux:heading size="xl">{{ $quiz->name }} - Lernen</flux:heading>

        <flux:separator class="my-5" />
    </div>

    <livewire:flashcard.flashcard-display
        :flashcard="$flashcards[$flashcardIndex]"
        :key="$flashcardIndex"
    />

    <flux:text class="my-5 text-center">
        {{ $flashcardIndex + 1 }} / {{ $flashcards->count() }}
    </flux:text>

    <div class="flex items-center gap-5 justify-center my-5">
        <flux:button wire:click="previous" icon="arrow-left">
            Vorherige
        </flux:button>
        <flux:button
            wire:click="next"
            variant="primary"
            icon-trailing="arrow-right"
        >
            Nächste
        </flux:button>
    </div>

    <div class="flex items-center justify-center my-5">
        <flux:button :href="route('quiz.show', $quiz)" icon-trailing="check">
            Fertig
        </flux:button>
    </div>
</div>
