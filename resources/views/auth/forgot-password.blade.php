<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
            <h2 class="text-2xl font-semibold text-gray-600 text-center">Forgot your password?</h2>
            <p class="text-sm text-gray-600 mt-1 text-center">
                No problem. Enter your email and we’ll send you a password reset link.
            </p>
        </x-slot>

        @session('status')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ $value }}
            </div>
        @endsession

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div>
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" autofocus autocomplete="username" placeholder="email@example.com" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button type="submit" variant="primary" :fullWidth="true">
                    {{ __('Email Password Reset Link') }}
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