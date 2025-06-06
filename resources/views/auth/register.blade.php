<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
            <h2 class="text-2xl font-semibold text-gray-600 text-center">Create an account</h2>
            <p class="text-sm text-gray-600 mt-1 text-center">Enter your details below to create your account</p>
        </x-slot>

        <livewire:auth.form-register />

        <div class="text-center mt-4 text-sm">
            Already have an account?
            <a href="{{ route('login') }}" class="text-primary hover:underline">Sign in</a>
        </div>
    </x-authentication-card>
</x-guest-layout>
