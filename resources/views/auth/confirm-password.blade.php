<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
            <h2 class="text-2xl font-semibold text-gray-600 text-center">Confirm your password</h2>
            <p class="text-sm text-gray-600 mt-1 text-center">
                This is a secure area of the application. Please confirm your password before continuing.
            </p>
        </x-slot>

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <div>
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" autofocus placeholder="Enter your password" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button type="submit" variant="primary" :fullWidth="true">
                    {{ __('Confirm') }}
                </x-button>
            </div>
        </form>

        <div class="text-center mt-4 text-sm">
            <a href="{{ route('login') }}" class="text-primary hover:underline">
                Back to login
            </a>
        </div>
    </x-authentication-card>
</x-guest-layout>