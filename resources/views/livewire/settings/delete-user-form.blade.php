<section class="mt-10 space-y-6">
    <div class="relative mb-5">
        <flux:heading>{{ __('Konto löschen') }}</flux:heading>
        <flux:subheading>
            {{ __('Lösche dein Konto und all deine Inhalte') }}
        </flux:subheading>
    </div>

    <flux:modal.trigger name="confirm-user-deletion">
        <flux:button
            variant="danger"
            x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        >
            {{ __('Konto löschen') }}
        </flux:button>
    </flux:modal.trigger>

    <flux:modal
        name="confirm-user-deletion"
        :show="$errors->isNotEmpty()"
        focusable
        class="max-w-lg"
    >
        <form method="POST" wire:submit="deleteUser" class="space-y-6">
            <div>
                <flux:heading size="lg">
                    {{ __('Bist du sicher, dass du dein Konto löschen möchtest?') }}
                </flux:heading>

                <flux:subheading>
                    {{ __('Sobald Ihr Konto gelöscht ist, werden alle darin enthaltenen Ressourcen und Daten dauerhaft gelöscht. Bitte geben Sie Ihr Passwort ein, um zu bestätigen, dass Sie Ihr Konto dauerhaft löschen möchten.') }}
                </flux:subheading>
            </div>

            <flux:input
                wire:model="password"
                :label="__('Passwort')"
                type="password"
            />

            <div class="flex justify-end space-x-2 rtl:space-x-reverse">
                <flux:modal.close>
                    <flux:button variant="filled">
                        {{ __('Abbrechen') }}
                    </flux:button>
                </flux:modal.close>

                <flux:button variant="danger" type="submit">
                    {{ __('Konto löschen') }}
                </flux:button>
            </div>
        </form>
    </flux:modal>
</section>
