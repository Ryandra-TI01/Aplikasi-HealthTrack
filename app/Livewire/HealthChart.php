<?php

namespace App\Livewire;

use App\Models\HealthRecord;
use Livewire\Component;

class HealthChart extends Component
{
    public $healthTypeId;

    public function mount($healthTypeId)
    {
        $this->healthTypeId = $healthTypeId;
    }

    public function render()
    {
        $records = HealthRecord::where('health_type_id', $this->healthTypeId)
            ->orderBy('recorded_at')
            ->get();

        // Ambil data tanggal dan value untuk chart
        $labels = $records->pluck('recorded_at')->map(fn($date) => \Carbon\Carbon::parse($date)->format('d M'))->toArray();
        $values = $records->pluck('value')->toArray();

        return view('livewire.health-chart', [
            'labels' => $labels,
            'values' => $values,
        ]);
    }
}
