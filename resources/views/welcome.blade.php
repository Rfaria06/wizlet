<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.head')
    </head>
    <body class="flex flex-col items-center justify-center h-[100vh]">
        <div class="flex items-center gap-4 mb-5">
            <x-app-logo />
        </div>
        @if (Route::has('login'))
            <nav class="flex items-center justify-end gap-4">
                @auth
                    <flux:button :href="route('dashboard')">
                        Dashboard
                    </flux:button>
                @else
                    <div class="flex items-center justify-center gap-5 w-full">
                        <flux:button :href="route('login')" variant="primary">
                            Login
                        </flux:button>

                        @if (Route::has('register'))
                            <flux:button :href="route('register')">
                                Registrieren
                            </flux:button>
                        @endif
                    </div>
                @endauth
            </nav>
        @endif

        @if (Route::has('login'))
            <div class="h-14.5 hidden lg:block"></div>
        @endif

        @fluxScripts
    </body>
</html>
