<a
    class="h-36 grow"
    href="{{ route('quiz.show', ['quiz' => $quiz]) }}"
    wire:navigate
>
    <flux:card class="h-36">
        <div class="h-full flex flex-col justify-between">
            <div>
                <flux:heading>{{ $quiz->name }}</flux:heading>

                <flux:subheading>{{ $this->description }}</flux:subheading>
            </div>

            <flux:text>{{ $quiz->user->name }}</flux:text>
        </div>
    </flux:card>
</a>
