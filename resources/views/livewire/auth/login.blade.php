<div class="flex flex-col gap-6">
    <x-auth-header
        :title="__('Login')"
        :description="__('Gib deine Anmeldedaten ein, um fortzufahren')"
    />

    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <form method="POST" wire:submit="login" class="flex flex-col gap-6">
        <!-- Email Address -->
        <flux:input
            wire:model="email"
            :label="__('Email')"
            type="email"
            required
            autofocus
            autocomplete="email"
            placeholder="email@example.com"
        />

        <!-- Password -->
        <div class="relative">
            <flux:input
                wire:model="password"
                :label="__('Passwort')"
                type="password"
                required
                autocomplete="current-password"
                :placeholder="__('Passwort')"
                viewable
            />

            @if (Route::has('password.request'))
                <flux:link
                    class="absolute top-0 text-sm end-0"
                    :href="route('password.request')"
                    wire:navigate
                >
                    {{ __('Passwort vergessen?') }}
                </flux:link>
            @endif
        </div>

        <!-- Remember Me -->
        <flux:checkbox wire:model="remember" :label="__('Login merken')" />

        <div class="flex items-center justify-end">
            <flux:button
                variant="primary"
                type="submit"
                class="w-full"
                data-test="login-button"
            >
                {{ __('Login') }}
            </flux:button>
        </div>
    </form>

    @if (Route::has('register'))
        <div
            class="space-x-1 text-sm text-center rtl:space-x-reverse text-zinc-600 dark:text-zinc-400"
        >
            <span>{{ __('Noch kein Konto?') }}</span>
            <flux:link :href="route('register')" wire:navigate>
                {{ __('Registrieren') }}
            </flux:link>
        </div>
    @endif
</div>
