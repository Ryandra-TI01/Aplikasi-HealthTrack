<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
            <h2 class="text-2xl font-semibold text-gray-600 text-center">Log in to your account</h2>
            <p class="text-sm text-gray-600 mt-1 text-center">Enter your email and password below to log in</p>
        </x-slot>

        @session('status')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ $value }}
            </div>
        @endsession

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" autofocus autocomplete="username" placeholder="email@example.com" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" autocomplete="current-password" placeholder="Password" />
            </div>

            <div class="mt-4 flex items-center justify-between">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" />
                    <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button type="submit" variant="primary" :fullWidth="true">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>
        <div class="text-center mt-4 text-sm">
            Don’t have an account?
            <a href="{{ route('register') }}" class="text-primary hover:underline">Sign up</a>
        </div>
    </x-authentication-card>
</x-guest-layout>
