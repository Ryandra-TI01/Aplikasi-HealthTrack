<div class="bg-primary/20 rounded-xl shadow-md p-4 w-full max-w-md">
    {{-- Rating stars --}}
    <div class="flex items-center gap-1 text-primary text-lg">
        {{-- Loop 5 stars --}}
        @for ($i = 1; $i <= 5; $i++)
            {{-- Show filled star if rating >= current index, otherwise outline star --}}
            <img src="{{ asset($feedback->rating >= $i ? 'images/star-fill.png' : 'images/star-outline.png') }}"
                alt="Rating star"
                class="w-10 h-10">
        @endfor
    </div>

    {{-- Feedback message --}}
    <p class="mt-4 text-gray-700 text-sm leading-relaxed">
        {{ $feedback->message }}
    </p>

    {{-- Action buttons --}}
    <div class="mt-6 flex gap-3">
        {{-- Dispatch event to trigger edit modal --}}
        <x-button wire:click="$dispatch('editFeedback', {id: {{ $feedback->id }} })"
            variant="cancel"
            
            >
            Edit Feedback
        </x-button>

        {{-- Confirm delete modal --}}
        <livewire:components.confirm-delete
            :record-id="$feedback->id"
            :model-class="\App\Models\Feedback::class"
            :model-name="'Feedback'"
            wire:key="delete-{{ $feedback->id }}" 
        />
    </div>
</div>
