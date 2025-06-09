<div>
    {{-- Modal Form --}}
    <x-modal wire:model="showModal" maxWidth="md">
        <form wire:submit.prevent="submit" class="bg-white shadow p-6 md:p-8 w-full">
            <h2 class="text-xl md:text-2xl font-semibold text-primary text-center">
                {{$isEdit ? 'Edit' : 'Submit' }} Your Feedback
            </h2>
            <p class="text-sm text-center text-gray-600 mt-1 mb-6">
                {{ $isEdit ? 'Update your previous feedback to help us serve you better.' : 'Please rate your experience and share any comments to help us improve.' }}
            </p>

            {{-- Rating --}}
            <div class="mb-4">
                <label class="block font-medium text-primary mb-1">Rating</label>
                <div class="flex gap-2">
                    @for ($i = 1; $i <= 5; $i++)
                        <button type="button" wire:click="setRating({{ $i }})">
                            <img src="{{ asset($rating >= $i ? 'images/star-fill.png' : 'images/star-outline.png') }}"
                                 alt="Rating star"
                                 class="w-10 h-10">
                        </button>
                    @endfor
                </div>
                @error('rating') <p class="text-sm text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Message --}}
            <div class="mb-6">
                <label for="message" class="block font-medium text-primary mb-1">Message</label>
                <x-textarea
                    name="message"
                    wire:model.live="message"
                    placeholder="Tell us what you liked or what we can do better.."
                />
                @error('message') <p class="text-sm text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Actions --}}
            <div class="flex justify-between gap-4">
                <x-button type="button"
                          wire:click="cancel"
                          variant="cancel">
                    Cancel
                </x-button>

                <x-button type="submit">
                    {{ $isEdit ? 'Update Feedback' : 'Send Feedback' }}
                </x-button>
            </div>
        </form>
    </x-modal>

</div>
