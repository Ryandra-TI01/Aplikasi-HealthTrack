<?php

namespace App\Livewire\Feedback;

use App\Models\Feedback;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Attributes\On;

class FeedbackForm extends Component
{
    public bool $showModal = false; // Controls visibility of the feedback modal form
    public bool $isEdit = false;    // Tracks if form is in edit mode or create mode
    public $feedback = null;        // Holds the Feedback model instance when editing

    #[Validate('required|integer|min:1|max:5')]
    public int $rating = 0;         // User rating value, must be between 1 and 5

    #[Validate('required|string|min:8|max:255')]
    public string $message = '';   // User feedback message, min 8 and max 255 chars

    // Event listener for opening the form in "create" mode
    #[On('openFeedbackForm')]
    public function create()
    {
        $this->resetForm();
        $this->isEdit = false;
        $this->feedback = null;
        $this->showModal = true;
    }

    // Event listener for opening the form in "edit" mode with existing feedback loaded
    #[On('editFeedback')]
    public function edit($id)
    {
        $this->feedback = Feedback::findOrFail($id);
        $this->rating = $this->feedback->rating;
        $this->message = $this->feedback->message;
        $this->isEdit = true;
        $this->showModal = true;
    }

    // Cancel button handler closes the modal without saving
    public function cancel()
    {
        $this->showModal = false;
    }

    // Form submission handler with validation and create/update logic
    public function submit()
    {
        $this->validate();

        try {
            if ($this->isEdit && $this->feedback) {
                // Update existing feedback
                $this->feedback->update([
                    'rating' => $this->rating,
                    'message' => $this->message,
                ]);
                $this->dispatch('show-alert', [
                    'type' => 'success',
                    'title' => 'Updateed',
                    'message' => 'Feedback has been updated successfully.',
                ]);

            } else {
                // Create new feedback
                Feedback::create([
                    'user_id' => auth()->id(),
                    'rating' => $this->rating,
                    'message' => $this->message,
                ]);
                $this->dispatch('show-alert', [
                    'type' => 'success',
                    'title' => 'Thank You',
                    'message' => 'Your feedback has been submitted.',
                ]);
            }

            // Reset form and close modal
            $this->resetForm();
            $this->showModal = false;

            // Notify other components (like feedback list) to refresh
            $this->dispatch('feedback-updated');
        } catch (\Exception $e) {
            $this->dispatch('show-alert', [
                'type' => 'error',
                'title' => 'Submission Failed',
                'message' => 'Something went wrong. Please try again.',
            ]);
        }
    }

    // Set rating when user clicks star button
    public function setRating($value)
    {
        $this->rating = $value;
    }

    // Reset form fields and states
    public function resetForm()
    {
        $this->rating = 0;
        $this->message = '';
        $this->isEdit = false;
        $this->feedback = null;
    }

    // Render the feedback form view
    public function render()
    {
        return view('livewire.feedback.feedback-form');
    }
}
