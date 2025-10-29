<section class="w-full">
    @include('partials.settings-heading')

    <x-settings.layout
        :heading="__('Profil')"
        :subheading="__('Aktualisiere deinen Namen und deine Email- Adresse')"
    >
        <form
            wire:submit="updateProfileInformation"
            class="my-6 w-full space-y-6"
        >
            <flux:input
                wire:model="name"
                :label="__('Name')"
                type="text"
                required
                autofocus
                autocomplete="name"
            />

            <div>
                <flux:input
                    wire:model="email"
                    :label="__('Email')"
                    type="email"
                    required
                    autocomplete="email"
                />

                @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail &&! auth()->user()->hasVerifiedEmail())
                    <div>
                        <flux:text class="mt-4">
                            {{ __('Deine Email ist nicht bestätigt.') }}

                            <flux:link
                                class="text-sm cursor-pointer"
                                wire:click.prevent="resendVerificationNotification"
                            >
                                {{ __('Klicke hier, um die verifizierungs- Mail erneut zu senden.') }}
                            </flux:link>
                        </flux:text>

                        @if (session('status') === 'verification-link-sent')
                            <flux:text
                                class="mt-2 font-medium !dark:text-green-400 !text-green-600"
                            >
                                {{ __('Neue verifizierungs- Mail gesendet.') }}
                            </flux:text>
                        @endif
                    </div>
                @endif
            </div>

            <div class="flex items-center gap-4">
                <div class="flex items-center justify-end">
                    <flux:button variant="primary" type="submit" class="w-full">
                        {{ __('Speichern') }}
                    </flux:button>
                </div>

                <x-action-message class="me-3" on="profile-updated">
                    {{ __('Gespeichert.') }}
                </x-action-message>
            </div>
        </form>

        <livewire:settings.delete-user-form />
    </x-settings.layout>
</section>
