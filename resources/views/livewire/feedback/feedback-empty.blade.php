<div class="bg-primary/10 rounded-xl shadow-md py-8 w-4/5 max-w-sm text-center mx-auto my-auto">
    {{-- Inform user that no feedback has been submitted yet --}}
    <p class="text-primary mb-6">
        You haven’t submitted any feedback yet.
    </p>

    {{-- Button to dispatch event to open the feedback submission form modal --}}
    <x-button type="button" variant="primary" wire:click="$dispatch('openFeedbackForm')"
            class="bg-primary text-white px-6 py-2 rounded hover:bg-primary-dark transition">
        Send Feedback
    </x-button>
</div>
