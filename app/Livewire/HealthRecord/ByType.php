<?php

namespace App\Livewire\HealthRecord;

use App\Models\HealthRecord;
use App\Models\HealthType;
use Livewire\Component;

class ByType extends Component
{
    public $typeId;
    public $healthType;
    public $records;
    public $showModal = false;
    public function mount($typeId)
    {
        $this->typeId = $typeId;
        $this->healthType = HealthType::findOrFail($typeId);
        $this->records = HealthRecord::where('health_type_id', $typeId)
            ->where('user_id', auth()->id())
            ->latest()
            ->get();
    }
    public function render()
    {
        return view('livewire.health-record.by-type')->layout('layouts.app');
    }
}
