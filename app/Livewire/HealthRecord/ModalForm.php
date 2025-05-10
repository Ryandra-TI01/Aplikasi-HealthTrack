<?php

namespace App\Livewire\HealthRecord;

use App\Models\HealthRecord;
use App\Models\HealthType;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class ModalForm extends Component
{
    public HealthType $healthType;
    public $recordId = null;
    public $value;
    public $notes;
    public $recordedAt;


    public function mount($healthType)
    {
        $this->healthType = $healthType;

    }
    #[On('edit-record')]
    public function editRecord($id)
    {
        $record = HealthRecord::find($id);
        $this->recordId = $record->id;
        $this->value = $record->raw_value ?? $record->value;
        $this->notes = $record->notes;
        $this->recordedAt = \Carbon\Carbon::parse($record->recorded_at)->format('Y-m-d\TH:i');
    }
    public function rules()
    {
        $baseRules = [
            'recordedAt' => 'required|date',
            'value' => 'required',
            'notes' => 'nullable|string|max:255',
        ];

        if ($this->healthType && $this->healthType->value_type === 'decimal') {
            $baseRules['value'] = 'required|numeric';
        } else {
            $baseRules['value'] = 'required|string|max:255';
        }

        return $baseRules;
    }

    public function submit()
    {
        $this->validate();

        HealthRecord::updateOrCreate(
        ['id' => $this->recordId], 
        [
            'user_id' => Auth::id(),
            'health_type_id' => $this->healthType->id,
            'recorded_at' => $this->recordedAt,
            'notes' => $this->notes,
            'value' => $this->healthType->value_type === 'decimal' ? $this->value : null,
            'raw_value' => $this->healthType->value_type === 'string' ? $this->value : null,
        ]);
        $this->dispatch('notify', type: 'success', message: 'Data Successfully Saved');
        $this->dispatch('scrollToTop');
        $this->dispatch('record-added');        
        $this->resetForm();
    }
    public function resetForm()
    {
        $this->recordId = null;
        $this->value = '';
        $this->notes = '';
        $this->recordedAt = now()->format('Y-m-d\TH:i');
    }

    public function render()
    {
        return view('livewire.health-record.modal-form');
    }
}
