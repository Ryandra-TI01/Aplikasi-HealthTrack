<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
            <h2 class="text-2xl font-semibold text-gray-600 text-center">
                Verify your email address
            </h2>
            <p class="text-sm text-gray-600 mt-1 text-center">
                Before continuing, please check your email inbox for a verification link.
                If you didn’t receive the email, we’ll send you another one.
            </p>
        </x-slot>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600 text-center">
                {{ __('A new verification link has been sent to the email address you provided.') }}
            </div>
        @endif

        <div class="mt-6 flex flex-col sm:flex-row items-center justify-between gap-4">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <x-button type="submit" variant="primary">
                    {{ __('Resend Verification Email') }}
                </x-button>
            </form>

            <div class="flex flex-col sm:flex-row items-center gap-2 text-sm">
                <a href="{{ route('profile.show') }}"
                   class="text-primary hover:underline">
                    {{ __('Edit Profile') }}
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-primary hover:underline">
                        {{ __('Log Out') }}
                    </button>
                </form>
            </div>
        </div>
    </x-authentication-card>
</x-guest-layout>