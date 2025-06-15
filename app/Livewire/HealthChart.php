<?php

namespace App\Livewire;

use App\Models\HealthRecord;
use App\Models\HealthType;
use Livewire\Attributes\On;
use Livewire\Component;

class HealthChart extends Component
{
    public $healthTypeId;
    public HealthType $healthType;
    public $labels;
    public $values;

    public function mount($healthTypeId)
    {
        $this->healthTypeId = $healthTypeId;
        $this->healthType = HealthType::where('id', $healthTypeId)->firstOrFail();
        $this->loadRecords();
    }
    #[On('healthDataType-updated')]
    public function loadRecords()
    {
        $records = HealthRecord::where('health_type_id', $this->healthTypeId)
            ->where('user_id', auth()->user()->id)
            ->orderBy('recorded_at')
            ->get();

        // Ambil data tanggal dan value untuk chart
        $this->labels = $records->pluck('recorded_at')->map(fn($date) => \Carbon\Carbon::parse($date)->format('d M'))->toArray();
        $this->values = $records->pluck('value')->toArray();
    }
    #[On('refresh-chart')]
    public function refreshComponent()
    {
        $this->loadRecords(); // reload data
    }

    public function render()
    {

        return view('livewire.health-chart', [
            'labels' => $this->labels,
            'values' => $this->values,
            'healthTypeUnit' => $this->healthType->unit,
            'healthTypeName' => $this->healthType->name
        ]);
    }
}
