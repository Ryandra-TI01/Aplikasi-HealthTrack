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

        <livewire:auth.form-login />

        <div class="text-center mt-4 text-sm">
            Don’t have an account?
            <a href="{{ route('register') }}" class="text-primary hover:underline">Sign up</a>
        </div>
    </x-authentication-card>
</x-guest-layout>
