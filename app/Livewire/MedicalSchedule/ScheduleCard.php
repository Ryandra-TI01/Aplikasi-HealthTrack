<?php

namespace App\Livewire\MedicalSchedule;

use App\Models\MedicalSchedule;
use Livewire\Attributes\On;
use Livewire\Component;

class ScheduleCard extends Component
{
    public $record;
    #[On('toggle-complete')]
    public function toggleComplete($id)
    {
        $schedule = MedicalSchedule::findOrFail($id);
        $schedule->is_completed = !$schedule->is_completed;
        $schedule->save();
        $this->dispatch('medical-schedule-updated');
    }
    public function render()
    {
        return view('livewire.medical-schedule.schedule-card');
    }
}
