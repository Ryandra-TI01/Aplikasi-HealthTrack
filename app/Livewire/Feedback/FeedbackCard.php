<?php

namespace App\Livewire\Feedback;

use Livewire\Attributes\On;
use Livewire\Component;
use App\Models\Feedback;

class FeedbackCard extends Component
{
    // Declare the feedback property with type hint for clarity
    public Feedback $feedback;

    /**
     * Render the feedback card view with the feedback data.
     */
    #[On('feedback-updated')]
    public function render()
    {
        return view('livewire.feedback.feedback-card', [
            'feedback' => $this->feedback,
        ]);
    }
}
