<form wire:submit="register" class="space-y-6">
    <div>
        <x-label for="name" value="Name" />
        <x-input id="name" type="text" wire:model.lazy="name" class="block mt-1 w-full" placeholder="Full Name" />
        @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    <div>
        <x-label for="email" value="Email" />
        <x-input id="email" type="email" wire:model.lazy="email" class="block mt-1 w-full" placeholder="email@example.com" />
        @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    <div>
        <x-label for="password" value="Password" />
        <x-input id="password" type="password" wire:model.lazy="password" class="block mt-1 w-full" />
        @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    <div>
        <x-label for="password_confirmation" value="Confirm Password" />
        <x-input id="password_confirmation" type="password" wire:model.lazy="passwordConfirmation" class="block mt-1 w-full" />
    </div>

    @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
        <div>
            <label class="flex items-center">
                <x-checkbox wire:model="terms" />
                <span class="ms-2 text-sm text-gray-600">
                    {!! __('I agree to the :terms_of_service and :privacy_policy', [
                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                    ]) !!}
                </span>
            </label>
            @error('terms') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
    @endif

    <div>
        <x-button type="submit" fullWidth="true">
            Register
        </x-button>
    </div>
</form>