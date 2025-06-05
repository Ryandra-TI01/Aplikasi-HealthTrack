<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
            <h2 class="text-2xl font-semibold text-gray-600 text-center">Two-Factor Authentication</h2>
            <p class="text-sm text-gray-600 mt-1 text-center" x-show="! recovery">
                Please enter the authentication code from your authenticator app.
            </p>
            <p class="text-sm text-gray-600 mt-1 text-center hidden" x-show="recovery">
                Please enter one of your emergency recovery codes.
            </p>
        </x-slot>

        <div x-data="{ recovery: false }">
            <form method="POST" action="{{ route('two-factor.login') }}">
                @csrf

                <div class="mt-4" x-show="! recovery">
                    <x-label for="code" value="{{ __('Authentication Code') }}" />
                    <x-input id="code" class="block mt-1 w-full" type="text" inputmode="numeric"
                        name="code" autofocus x-ref="code" autocomplete="one-time-code"
                        placeholder="123 456" />
                </div>

                <div class="mt-4" x-show="recovery" x-cloak>
                    <x-label for="recovery_code" value="{{ __('Recovery Code') }}" />
                    <x-input id="recovery_code" class="block mt-1 w-full" type="text"
                        name="recovery_code" x-ref="recovery_code" autocomplete="one-time-code"
                        placeholder="recovery-code-123" />
                </div>

                <div class="flex flex-col sm:flex-row sm:items-center justify-between mt-6 gap-2">
                    <div>
                        <button type="button"
                            class="text-sm text-gray-600 hover:text-gray-900 underline cursor-pointer"
                            x-show="! recovery"
                            x-on:click="
                                recovery = true;
                                $nextTick(() => { $refs.recovery_code.focus() })
                            ">
                            {{ __('Use a recovery code') }}
                        </button>

                        <button type="button"
                            class="text-sm text-gray-600 hover:text-gray-900 underline cursor-pointer"
                            x-show="recovery" x-cloak
                            x-on:click="
                                recovery = false;
                                $nextTick(() => { $refs.code.focus() })
                            ">
                            {{ __('Use an authentication code') }}
                        </button>
                    </div>

                    <x-button type="submit" variant="primary">
                        {{ __('Log in') }}
                    </x-button>
                </div>
            </form>
        </div>
    </x-authentication-card>
</x-guest-layout>