<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
            <h2 class="text-2xl font-semibold text-gray-600 text-center">Reset your password</h2>
            <p class="text-sm text-gray-600 mt-1 text-center">
                Enter your new password and confirm it below.
            </p>
        </x-slot>

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div class="mt-4">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email"
                    :value="old('email', $request->email)" required autofocus autocomplete="username"
                    placeholder="email@example.com" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('New Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password"
                    required autocomplete="new-password" placeholder="New password" />
            </div>

            <div class="mt-4">
                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-input id="password_confirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" required autocomplete="new-password"
                    placeholder="Confirm new password" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button type="submit" variant="primary" :fullWidth="true">
                    {{ __('Reset Password') }}
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
