<?php

namespace App\Livewire\Home\HealthGlance;

use App\Models\HealthRecord;
use Auth;
use Livewire\Component;

class LatestHealthTypes extends Component
{
     public $data = [];

    public function mount()
    {
        $userId = Auth::id();
        $latestRecords = HealthRecord::with('healthType')
            ->where('user_id', $userId)
            ->latest('recorded_at')
            ->take(3)
            ->get();

        $this->data = $latestRecords->map(function ($record) {
            return [
                'name' => $record->healthType->name,
                'value' => $record->value,
                'unit' => $record->healthType->unit,
            ];
        });
    }
    public function render()
    {
        return view('livewire.home.health-glance.latest-health-types');
    }
}
