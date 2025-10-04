<div class="group [perspective:1000px] h-40 cursor-pointer" wire:click="flip">
    <div
        class="relative w-full h-full transition-transform duration-500 [transform-style:preserve-3d]"
        style="transform: rotateY({{ $flipped ? '180deg' : '0deg' }})"
    >
        <!-- Front -->
        <flux:card
            class="absolute inset-0 flex justify-center items-center backface-hidden"
        >
            <flux:heading size="xl">{{ $flashcard->question }}</flux:heading>
        </flux:card>

        <!-- Back -->
        <flux:card
            class="absolute inset-0 flex justify-center items-center backface-hidden [transform:rotateY(180deg)]"
        >
            <flux:heading size="xl">{{ $flashcard->answer }}</flux:heading>
        </flux:card>
    </div>
</div>
