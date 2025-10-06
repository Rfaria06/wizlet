<div>
    <flux:modal.trigger name="edit-flashcard-modal-{{ $flashcard->id }}">
        <flux:button icon-trailing="pencil">Bearbeiten</flux:button>
    </flux:modal.trigger>

    <flux:modal
        name="edit-flashcard-modal-{{ $flashcard->id }}"
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
