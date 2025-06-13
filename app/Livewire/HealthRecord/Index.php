<?php

namespace App\Livewire\HealthRecord;

use App\Models\HealthRecord;
use App\Models\HealthType;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Index extends Component
{
    public string $search = '';
    public $healthTypes;
    public $selectedHealthType;
    public bool $showModal = false;

    #[Validate('required|exists:health_types,id')]
    public $healthTypeId;

    #[Validate('required|date')]
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
        $this->healthTypeId = null;
        $this->recordedAt = now()->format('Y-m-d\TH:i');
        $this->notes = null;
        $this->raw_value = null;
        $this->value = null;
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

    public function updated($property)
    {
        $this->validateOnly($property);

        if ($property === 'healthTypeId') {
            $this->selectedHealthType = $this->healthTypes->find($this->healthTypeId);
        }

        if ($property === 'value' && optional($this->selectedHealthType)->value_type === 'decimal') {
            $this->addError('value', 'The value field is required and must be numeric.');
        }

        if ($property === 'raw_value' && optional($this->selectedHealthType)->value_type === 'string') {
            $this->addError('raw_value', 'The raw value field is required and must be a string.');
        }
    }

        public function getFilteredHealthTypesProperty()
        {
            return HealthType::whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($this->search) . '%'])->get();
        }

    public function submit()
    {
        $this->validate(); // ini validasi dasar

        if (!$this->selectedHealthType) {
            $this->addError('healthTypeId', 'Health Type is not selected.');
            return;
        }

        // validasi berdasarkan value_type
        if ($this->selectedHealthType->value_type === 'decimal') {
            if (!is_numeric($this->value)) {
                $this->addError('value', 'This field is required and must be numeric.');
                return;
            }
        } elseif ($this->selectedHealthType->value_type === 'string') {
            if (empty($this->raw_value)) {
                $this->addError('raw_value', 'This field is required.');
                return;
            }
        }

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

    public function render()
    {
        return view('livewire.health-record.index')->layout('layouts.app');
    }
}