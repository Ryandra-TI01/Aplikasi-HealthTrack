<?php

namespace App\Livewire\HealthRecord;

use App\Models\HealthRecord;
use App\Models\HealthType;
use Livewire\Attributes\On;
use Livewire\Component;

class Index extends Component
{
    public string $search = '';
    public $healthTypes;
    public $selectedHealthType;

    public bool $showModal = false;

    public $healthTypeId;
    public $recordedAt;
    public ?string $notes = null;
    public ?string $raw_value = null;
    public $value = null;

    #[On('openHealthRecordForm')]
    public function create()
    {
        $this->resetForm();
        $this->showModal = true;
    }

    public function resetForm()
    {
        $this->reset([
            'healthTypeId',
            'recordedAt',
            'notes',
            'raw_value',
            'value',
            'selectedHealthType'
        ]);

        $this->recordedAt = now()->format('Y-m-d\TH:i');
    }

    public function cancel()
    {
        $this->showModal = false;
    }

    public function mount()
    {
        $this->healthTypes = HealthType::all();
        $this->recordedAt = now()->format('Y-m-d\TH:i');
    }

    public function updatedHealthTypeId()
    {
        $this->selectedHealthType = $this->healthTypes->find($this->healthTypeId);
    }

    protected function rules(): array
    {
        $rules = [
            'healthTypeId' => 'required|exists:health_types,id',
            'recordedAt' => 'required|date',
        ];

        if ($this->selectedHealthType) {
            if ($this->selectedHealthType->value_type === 'decimal') {
                $rules['value'] = 'required|numeric';
            }

            if ($this->selectedHealthType->value_type === 'string') {
                $rules['raw_value'] = 'required|string';
            }
        }

        return $rules;
    }
    public function updated($property)
    {
        $this->validateOnly($property);
    }
    public function submit()
    {
        $this->validate();

        try {
            HealthRecord::create([
                'user_id' => auth()->id(),
                'health_type_id' => $this->healthTypeId,
                'recorded_at' => $this->recordedAt,
                'value' => $this->selectedHealthType->value_type === 'decimal' ? $this->value : null,
                'raw_value' => $this->selectedHealthType->value_type === 'string' ? $this->raw_value : null,
                'notes' => $this->notes,
            ]);

            $this->dispatch('show-alert', [
                'type' => 'success',
                'title' => 'Thank You!',
                'message' => 'Your health data has been submitted.',
            ]);

            $this->resetForm();
            $this->cancel();
        } catch (\Throwable $th) {
            $this->dispatch('show-alert', [
                'type' => 'error',
                'title' => 'Error',
                'message' => $th->getMessage(),
            ]);
        }
    }

    public function getFilteredHealthTypesProperty()
    {
        return HealthType::whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($this->search) . '%'])->get();
    }

    public function render()
    {
        return view('livewire.health-record.index')->layout('layouts.app');
    }
}
