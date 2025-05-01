<?php

namespace App\Livewire\HealthRecord;

use App\Models\HealthRecord;
use App\Models\HealthType;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ModalForm extends Component
{
    public HealthType $healthType;
    public $value;
    public $notes;
    public $recordedAt;


    public function mount($healthType)
    {
        $this->healthType = $healthType;
        $this->recordedAt = now()->format('Y-m-d\TH:i');

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

        HealthRecord::create([
            'user_id' => Auth::id(),
            'health_type_id' => $this->healthType->id,
            'recorded_at' => $this->recordedAt,
            'notes' => $this->notes,
            'value' => $this->healthType->value_type === 'decimal' ? $this->value : null,
            'raw_value' => $this->healthType->value_type === 'string' ? $this->value : null,
        ]);

        $this->dispatch('notify', type: 'success', message: 'Data Successfully Saved');
        $this->dispatch('record-added');        
        session()->flash('message', 'Data berhasil disimpan.');
        $this->reset(['value', 'notes']);
    }

    public function render()
    {
        return view('livewire.health-record.modal-form');
    }
}
