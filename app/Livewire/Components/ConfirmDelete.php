<?php

namespace App\Livewire\Components;

use Livewire\Component;

class ConfirmDelete extends Component
{
    // The ID of the record to be deleted
    public $recordId;

    // The model class name (e.g., App\Models\Feedback)
    public $modelClass;

    // The model's display name (for UI messages)
    public $modelName;

    // State to control the delete confirmation modal
    public $confirmDelete = [
        'open' => false,
    ];
    // custom icon
    public $icon;

    // Initialize the component with required data
    public function mount($recordId, $modelClass, $modelName = 'Record')
    {
        $this->recordId = $recordId;
        $this->modelClass = $modelClass;
        $this->modelName = $modelName;
    }

    // Open the confirmation modal
    public function confirmDelete()
    {
        $this->confirmDelete['open'] = true;
    }

    // Delete the record from the database
    public function deleteRecord()
    {
        // Basic validation: check if required data exists
        if (!$this->recordId || !$this->modelClass) {
            $this->dispatch('notify', type: 'error', message: 'Invalid deletion request');
            return;
        }

        // Resolve the model and find the specific record
        $model = app($this->modelClass)->findOrFail($this->recordId);

        // Optional: prevent deletion if the record doesn't belong to the current user
        if (isset($model->user_id) && $model->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        // Delete the model
        $model->delete();

        // Close the modal
        $this->confirmDelete['open'] = false;

        // Dispatch a custom event (can be listened to by the parent)
        $eventName = strtolower(str_replace(' ', '-', $this->modelName)) . '-deleted';
        $this->dispatch($eventName);

        // Optional: Scroll to the top (e.g. for better UX)
        $this->dispatch('scrollToTop');

        // Trigger a toast/notification (assuming there's a listener)
        $this->dispatch('notify', type: 'success', message: "{$this->modelName} has been deleted");

        // Global alert modal trigger — make sure the parent component listens for this!
        $this->dispatch('show-alert', [
            'type' => 'success',
            'title' => 'Deleted!',
            'message' => "The {$this->modelName} was successfully deleted.",
        ]);
    }

    // Cancel deletion and close the modal
    public function cancelDelete()
    {
        $this->confirmDelete['open'] = false;
    }

    // Render the Blade view for this Livewire component
    public function render()
    {
        return view('livewire.components.confirm-delete');
    }
}
