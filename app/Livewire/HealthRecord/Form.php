<?php

namespace App\Livewire\HealthRecord;

use App\Models\HealthRecord;
use App\Models\HealthType;
use Auth;
use Livewire\Component;

class Form extends Component
{
        // id untuk health type
        public $healthTypeId;
        // nilai untuk health type berupa value atau raw_value
        public $value;
        // waktu record
        public $recordedAt;
        // semua health type
        public $healthTypes;
        // health type yang dipilih user
        public $selectedHealthType;
    
        public function mount()
        {
            $this->healthTypes = HealthType::all();
            $this->recordedAt = now()->format('Y-m-d\TH:i'); // format untuk input datetime-local
        }
    
        public function updatedHealthTypeId($healthTypeId)
        {
            $this->selectedHealthType = $this->healthTypes->find($healthTypeId);
        }
    
        public function rules()
        {
            $baseRules = [
                'healthTypeId' => 'required|exists:health_types,id',
                'recordedAt' => 'required|date',
                'value' => 'required',
            ];
    
            if ($this->selectedHealthType && $this->selectedHealthType->value_type === 'decimal') {
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
                'health_type_id' => $this->healthTypeId,
                'recorded_at' => $this->recordedAt,
                'user_id' => Auth::id(),
                'value' => $this->selectedHealthType->value_type === 'decimal' ? $this->value : null,
                'raw_value' => $this->selectedHealthType->value_type === 'string' ? $this->value : null,
            ]);
    
            session()->flash('message', 'Data berhasil disimpan.');
    
            $this->reset(['healthTypeId', 'value', 'selectedHealthType']);
            $this->recordedAt = now()->format('Y-m-d\TH:i');
        }
    public function render()
    {
        return view('livewire.health-record.form');
    }
}
