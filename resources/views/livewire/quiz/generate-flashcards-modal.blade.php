<div>
    <flux:modal.trigger name="generate-flashcards-modal">
        <flux:button variant="primary" icon-trailing="sparkles">
            Generieren
        </flux:button>
    </flux:modal.trigger>

    <flux:modal
        name="generate-flashcards-modal"
        class="m-3 my-auto sm:mx-auto w-full"
    >
        <div class="mb-3">
            <flux:heading size="lg">Lernkarten generieren</flux:heading>
            <flux:text>
                Erstelle Lernkarten mit Künstlicher Intelligenz! Gib ein Thema
                an, oder kopiere Informationen zu deinem Gewünschten Thema in
                das Textfeld.
            </flux:text>
        </div>

        <form wire:submit="generate" class="flex flex-col gap-2">
            <flux:textarea
                label="Prompt"
                wire:model="prompt"
                placeholder="Erstelle Karten zu Formel 1"
            />

            <flux:button variant="primary" type="submit" class="mt-5">
                Generieren!
            </flux:button>
        </form>
    </flux:modal>
</div>
