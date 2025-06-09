<?php

namespace App\Livewire\Feedback;

use App\Models\Feedback;
use Livewire\Attributes\On;
use Livewire\Component;

class FeedbackSection extends Component
{
    // Listen for feedback update or delete events to trigger component re-render
    #[On('feedback-updated')]
    #[On('feedback-deleted')]
    public function refreshFeedback()
    {
        // This method is intentionally left empty.
        // It is only used to force the component to re-render when the event is fired.
    }

    public function render()
    {
        // Get the latest feedback from the currently authenticated user
        $feedback = Feedback::where('user_id', auth()->id())->first();

        return view('livewire.feedback.feedback-section', compact('feedback'));
    }
}
