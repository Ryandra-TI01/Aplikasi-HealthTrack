<?php

namespace App\Livewire\Components;

use Livewire\Component;

class ConfirmDelete extends Component
{
        public $recordId;
    public $modelClass;
    public $modelName;
    public $confirmDelete = [
        'open' => false,
    ];

    public function mount($recordId, $modelClass, $modelName = 'Record')
    {
        $this->recordId = $recordId;
        $this->modelClass = $modelClass;
        $this->modelName = $modelName;
    }

    public function confirmDelete()
    {
        $this->confirmDelete['open'] = true;
    }

    public function deleteRecord()
    {
        if (!$this->recordId || !$this->modelClass) {
            $this->dispatch('notify', type: 'error', message: 'Invalid deletion request');
            return;
        }

        $model = app($this->modelClass)->findOrFail($this->recordId);

        if (method_exists($model, 'user_id') && $model->user_id !== auth()->id()) {
            abort(403, 'Tidak diizinkan');
        }

        $model->delete();

        $this->confirmDelete['open'] = false;

        $eventName = strtolower(str_replace(' ', '-', $this->modelName)) . '-deleted';
        $this->dispatch($eventName);
        $this->dispatch('scrollToTop');
        $this->dispatch('notify', type: 'success', message: "{$this->modelName} berhasil dihapus");
    }

    public function cancelDelete()
    {
        $this->confirmDelete['open'] = false;
    }
    public function render()
    {
        return view('livewire.components.confirm-delete');
    }
}
