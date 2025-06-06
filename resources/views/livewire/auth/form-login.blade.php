<form wire:submit.prevent="login">
    <div>
        <x-label for="email" value="{{ __('Email') }}" />
        <x-input id="email" class="block mt-1 w-full" wire:model.live="email" autofocus autocomplete="username" placeholder="email@example.com" />
        @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    <div class="mt-4">
        <x-label for="password" value="{{ __('Password') }}" />
        <x-input id="password" class="block mt-1 w-full" type="password" wire:model.live="password" autocomplete="current-password" />
        @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    <div class="mt-4 flex items-center justify-between">
        <label for="remember_me" class="flex items-center">
            <x-checkbox id="remember_me" wire:model="remember" />
            <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
        </label>
        @if (Route::has('password.request'))
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md" href="{{ route('password.request') }}">
                {{ __('Forgot your password?') }}
            </a>
        @endif
    </div>

    <div class="flex items-center justify-end mt-4">
        <x-button type="submit" variant="primary" fullWidth="true">
            {{ __('Log in') }}
        </x-button>
    </div>
</form>
