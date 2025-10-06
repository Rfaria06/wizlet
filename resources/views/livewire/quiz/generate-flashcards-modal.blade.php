<div>
    <flux:modal.trigger name="generate-flashcards-modal">
        <flux:button variant="primary" icon-trailing="sparkles">Generate</flux:button>
    </flux:modal.trigger>

    <flux:modal name="generate-flashcards-modal" class="m-3 my-auto sm:mx-auto w-full">
        <div class="mb-3">
            <flux:heading size="lg">Generate cards</flux:heading>
            <flux:text>Create flashcards using artificial intelligence! Enter a prompt, like a topic about which to create flashcards, or paste in information from text</flux:text>
        </div>

        <form wire:submit="generate" class="flex flex-col gap-2">
            <flux:textarea label="Prompt" wire:model="prompt" placeholder="Generate Cards about formula 1" />

            <flux:button variant="primary" type="submit" class="mt-5">
                Generate!
            </flux:button>
        </form>
    </flux:modal>
</div>
