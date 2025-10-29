<div class="flex flex-col gap-6">
    <x-auth-header
        :title="__('Konto erstellen')"
        :description="__('Fülle die Details aus, um dein Konto zu erstellen')"
    />

    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <form method="POST" wire:submit="register" class="flex flex-col gap-6">
        <!-- Name -->
        <flux:input
            wire:model="name"
            :label="__('Name')"
            type="text"
            required
            autofocus
            autocomplete="name"
            :placeholder="__('Ganzer Name')"
        />

        <!-- Email Address -->
        <flux:input
            wire:model="email"
            :label="__('Email')"
            type="email"
            required
            autocomplete="email"
            placeholder="email@example.com"
        />

        <!-- Password -->
        <flux:input
            wire:model="password"
            :label="__('Passwort')"
            type="password"
            required
            autocomplete="new-password"
            :placeholder="__('Password')"
            viewable
        />

        <!-- Confirm Password -->
        <flux:input
            wire:model="password_confirmation"
            :label="__('Password bestätigen')"
            type="password"
            required
            autocomplete="new-password"
            :placeholder="__('Password bestätigen')"
            viewable
        />

        <div class="flex items-center justify-end">
            <flux:button type="submit" variant="primary" class="w-full">
                {{ __('Konto erstellen') }}
            </flux:button>
        </div>
    </form>

    <div
        class="space-x-1 rtl:space-x-reverse text-center text-sm text-zinc-600 dark:text-zinc-400"
    >
        <span>{{ __('Schon ein Konto?') }}</span>
        <flux:link :href="route('login')" wire:navigate>
            {{ __('Login') }}
        </flux:link>
    </div>
</div>
