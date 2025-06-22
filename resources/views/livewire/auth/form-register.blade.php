<form wire:submit="register" class="space-y-6">
    <div>
        <x-label for="name" value="Name" />
        <x-input id="name" type="text" wire:model.live="name" name="name" placeholder="Full Name" />
        @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    <div>
        <x-label for="email" value="Email" />
        <x-input id="email" type="email" wire:model.live="email" name="email" placeholder="email@example.com" />
        @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    <div>
        <x-label for="password" value="Password" />
        <x-input id="password" type="password" wire:model.live="password" name="password"/>
        @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    <div>
        <x-label for="password_confirmation" value="Confirm Password" />
        <x-input id="password_confirmation" type="password" name="password_confirmation" wire:model.live="password_confirmation" />
        @error('password_confirmation') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
        <div>
            <label class="flex items-center">
                <x-checkbox wire:model.live="terms" name="terms" />
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

        <x-loading-button wire:click="register" fullWidth>
            Register
        </x-loading-button>

    </div>
</form>