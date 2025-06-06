<form wire:submit="sendResetLink" class="space-y-6">
    @if ($status)
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ $status }}
        </div>
    @endif

    <div>
        <x-label for="email" value="Email" />
        <x-input id="email" type="email" wire:model.lazy="email" class="block mt-1 w-full" placeholder="email@example.com" />
        @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    <div class="flex items-center justify-end mt-4">
        <x-button type="submit" variant="primary" :fullWidth="true">
            {{ __('Email Password Reset Link') }}
        </x-button>
    </div>

</form>
