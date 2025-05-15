<?php

namespace App\Livewire\HealthRecord;

use App\Models\HealthRecord;
use App\Models\HealthType;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Livewire\Component;

class Download extends Component
{
    public $startDate;
    public $endDate;
    public $selectedTypes = [];
    public $healthTypes;
    public $results = [];

    public function mount()
    {
        $this->healthTypes = HealthType::select('id', 'name')->get();
        $this->endDate = Carbon::now()->format('Y-m-d');
    }

    public function showData()
    {
        $this->validate([
            'startDate' => 'required|date',
            'endDate' => 'required|date|after_or_equal:startDate',
            'selectedTypes' => 'required|array|min:1',
        ]);

        $this->results = [];

        foreach ($this->selectedTypes as $typeId) {
            $records = HealthRecord::where('user_id', auth()->id())
                ->where('health_type_id', $typeId)
                ->whereBetween('recorded_at', [$this->startDate, $this->endDate])
                ->orderBy('recorded_at')
                ->get();

            $this->results[$typeId] = $records;
        }
    }

    public function render()
    {
        return view('livewire.health-record.download');
    }
}
