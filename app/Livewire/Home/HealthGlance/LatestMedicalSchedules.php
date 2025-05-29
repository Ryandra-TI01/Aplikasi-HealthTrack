<?php

namespace App\Livewire\Home\HealthGlance;

use App\Models\MedicalSchedule;
use Auth;
use Livewire\Component;

class LatestMedicalSchedules extends Component
{
    public $schedules = [];

    public function mount()
    {
        $userId = Auth::id();
        $this->schedules = MedicalSchedule::where('user_id', $userId)
            // ->whereDate('reminder_time', '>=', now())
            ->orderBy('reminder_time')
            ->take(3)
            ->get()
            ->map(function ($item) {
                $item->reminder_time = \Carbon\Carbon::parse($item->reminder_time);
                return $item;
            });
    }
    public function render()
    {
        return view('livewire.home.health-glance.latest-medical-schedules');
    }
}
