@php
    use App\Models\Quiz;
@endphp

<div>
    <div>
        <div class="flex items-center gap-4">
            @can('create', Quiz::class)
                <livewire:quiz.create-quiz-modal />
            @endcan

            <flux:input
                wire:model.live.debounce.650ms="search"
                placeholder="Suchen..."
                clearable
                icon-trailing="magnifying-glass"
            />

            <flux:switch
                wire:model.live.debounce.650ms="onlyOwned"
                label="Eigene"
            />
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 my-5">
            @foreach ($this->quizzes as $quiz)
                <livewire:quiz.quiz-card :$quiz wire:key="{{ $quiz->id }}" />
            @endforeach
        </div>

        {{ $this->quizzes->links() }}
    </div>
</div>
