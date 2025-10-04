<div>
    <flux:modal.trigger name="create-quiz-modal">
        <flux:button variant="primary" icon-trailing="{{ $this->quiz->exists ? 'pencil' : 'plus' }}">{{ $this->quiz->exists ? "Bearbeiten" : "Neu" }}</flux:button>
    </flux:modal.trigger>

    <flux:modal name="create-quiz-modal" class="m-3 my-auto sm:mx-auto w-full">
        <div class="mb-3">
            <flux:heading size="lg">Quiz erstellen</flux:heading>
        </div>

        <form wire:submit="save" class="flex flex-col gap-2">
            <flux:input label="Name" wire:model="name" />

            <flux:textarea label="Beschreibung" wire:model="description" />

            <flux:checkbox label="Öffentlich" wire:model="public" />

            <flux:button variant="primary" type="submit" class="mt-5">Speichern</flux:button>
        </form>
    </flux:modal>
</div>
