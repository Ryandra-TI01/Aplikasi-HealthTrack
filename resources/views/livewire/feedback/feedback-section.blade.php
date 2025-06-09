<div class="max-w-4xl mx-auto flex flex-col md:flex-row items-center justify-center gap-8 px-4">
    {{-- Left: Feedback card or empty state --}}
    <div class="md:w-1/2">
        @if($feedback)
            {{-- Display user's feedback card --}}
            <livewire:feedback.feedback-card :feedback="$feedback" />
        @else
            {{-- Show empty state if no feedback is available --}}
            <livewire:feedback.feedback-empty />
        @endif
    </div>

    {{-- Right: Static feedback illustration --}}
    <div class="max-w-xs pb-8">
        <img src="{{ asset('images/feedback-illustration.png') }}" alt="Feedback Illustration" class="w-full -mb-20 -mt-8">
    </div>
    
    {{-- Global feedback form modal (outside main layout for clarity) --}}
    <livewire:feedback.feedback-form />
</div>

