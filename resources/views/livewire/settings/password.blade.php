<section class="w-full">
    @include('partials.settings-heading')

    <x-settings.layout
        :heading="__('Passwort aktualisieren')"
        :subheading="__('Benutze ein langes und sicheres passwort, um die Sicherheit zu erhöhen.')"
    >
        <form method="POST" wire:submit="updatePassword" class="mt-6 space-y-6">
            <flux:input
                wire:model="current_password"
                :label="__('Aktuelles Passwort')"
                type="password"
                required
                autocomplete="current-password"
            />
            <flux:input
                wire:model="password"
                :label="__('Neues Passwort')"
                type="password"
                required
                autocomplete="new-password"
            />
            <flux:input
                wire:model="password_confirmation"
                :label="__('Passwort bestätigen')"
                type="password"
                required
                autocomplete="new-password"
            />

            <div class="flex items-center gap-4">
                <div class="flex items-center justify-end">
                    <flux:button variant="primary" type="submit" class="w-full">
                        {{ __('Speichern') }}
                    </flux:button>
                </div>

                <x-action-message class="me-3" on="password-updated">
                    {{ __('Gespeichert.') }}
                </x-action-message>
            </div>
        </form>
    </x-settings.layout>
</section>
