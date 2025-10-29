<section class="w-full">
    @include('partials.settings-heading')

    <x-settings.layout
        :heading="__('Anzeige')"
        :subheading=" __('Aktualisiere die Anzeigeeinstellungen für dein Konto')"
    >
        <flux:radio.group
            x-data
            variant="segmented"
            x-model="$flux.appearance"
        >
            <flux:radio value="light" icon="sun">{{ __('Hell') }}</flux:radio>
            <flux:radio value="dark" icon="moon">
                {{ __('Dunkel') }}
            </flux:radio>
            <flux:radio value="system" icon="computer-desktop">
                {{ __('System') }}
            </flux:radio>
        </flux:radio.group>
    </x-settings.layout>
</section>
