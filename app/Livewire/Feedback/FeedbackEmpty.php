<?php

namespace App\Livewire\Feedback;

use Livewire\Component;

class FeedbackEmpty extends Component
{
    /**
     * Render the view for empty feedback state.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        // Return the Blade view for empty feedback UI
        return view('livewire.feedback.feedback-empty');
    }
}
