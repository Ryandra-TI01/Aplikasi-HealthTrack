<?php

namespace App\Livewire\HealthRecord;

use App\Models\HealthRecord;
use App\Models\HealthType;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Livewire\Attributes\On;
use Livewire\Component;

class Download extends Component
{
    public $startDate;
    public $endDate;
    public $selectedTypes = [];
    public $healthTypes;
    public $results = [];
    public bool $hasPreviewed = false;
    public bool $showModal = false;
    public bool $selectAll = false;

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

        $this->hasPreviewed = true; // 👉 trigger tampilan chart + tabel
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectedTypes = $this->healthTypes->pluck('id')->map(fn($id) => (string)$id)->toArray();
        } else {
            $this->selectedTypes = [];
        }
    }

    #[On('showTypeModal')]
    public function open()
    {
        $this->showModal = true;
    }
     public function cancel()
    {
        $this->selectedTypes = [];
        $this->showModal = false;
    }

    public function render()
    {
        return view('livewire.health-record.download')->layout('layouts.app');
    }
}
