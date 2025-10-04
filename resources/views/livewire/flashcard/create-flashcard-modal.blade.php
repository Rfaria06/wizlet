<div>
    <flux:modal.trigger name="create-flashcard-modal">
        <flux:button variant="primary" icon-trailing="plus">
            Neue Karte
        </flux:button>
    </flux:modal.trigger>

    <flux:modal
        name="create-flashcard-modal"
        class="m-3 my-auto sm:mx-auto w-full"
    >
        <form wire:submit="save" class="flex flex-col gap-2">
            <flux:textarea label="Frage" wire:model="question" />

            <flux:textarea label="Antwort" wire:model="answer" />

            <flux:button variant="primary" type="submit" class="mt-5">
                Speichern
            </flux:button>
        </form>
    </flux:modal>
</div>
