<?php

namespace App\Livewire\HealthRecord;

use App\Models\HealthRecord;
use App\Models\HealthType;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Modelable;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Attributes\Computed;

class ModalForm extends Component
{
    public int $healthTypeId;
    public HealthType $healthType;
    public $recordId = null;
    public $value;
    public $notes;
    public $recordedAt;

    #[Modelable]
    public bool $showModal = false;
    public function mount($healthTypeId)
    {
        $this->healthTypeId = $healthTypeId;
        $this->healthType = HealthType::findOrFail($this->healthTypeId);
        $this->resetForm();
    }

    #[On('edit-record')]
    public function editRecord($id)
    {
        $record = HealthRecord::find($id);
        if (!$record) return;

        $this->recordId = $record->id;
        $this->value = $record->raw_value ?? $record->value;
        $this->notes = $record->notes;
        $this->recordedAt = \Carbon\Carbon::parse($record->recorded_at)->format('Y-m-d\TH:i');
    }

    #[Computed]
    public function rules(): array
    {
        return [
            'recordedAt' => 'required|date',
            'value' => $this->healthType->value_type === 'decimal' ? 'required|numeric' : 'required|string|max:255',
            'notes' => 'nullable|string|max:255',
        ];
    }
    
    #[On('reset-form')]
    public function resetForm()
    {
        $this->recordId = null;
        $this->value = '';
        $this->notes = '';
        $this->recordedAt = now()->format('Y-m-d\TH:i');
        $this->resetValidation(); // <— hapus error sebelumnya

    }

    public function cancel()
    {
        $this->resetForm();
        $this->showModal = false;
    }

    public function submit()
    {
        $this->validate();

        HealthRecord::updateOrCreate(
            ['id' => $this->recordId],
            [
                'user_id' => Auth::id(),
                'health_type_id' => $this->healthTypeId,
                'recorded_at' => $this->recordedAt,
                'notes' => $this->notes,
                'value' => $this->healthType->value_type === 'decimal' ? $this->value : null,
                'raw_value' => $this->healthType->value_type === 'string' ? $this->value : null,
            ]
        );

        $this->dispatch('healthDataType-updated');
        $this->dispatch('scrollToTop');
        $this->dispatch('show-alert', [
            'type' => 'success',
            'title' => 'Success',
            'message' => 'Your health data has been submitted.',
        ]);

        $this->cancel();
    }

    public function render()
    {
        return view('livewire.health-record.modal-form');
    }
}
