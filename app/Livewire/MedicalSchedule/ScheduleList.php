<?php

namespace App\Livewire\MedicalSchedule;

use App\Models\MedicalSchedule;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class ScheduleList extends Component
{
    use WithPagination;
    public $deletingId;

    #[On('medical-schedule-deleted')]
    #[On('medical-schedule-added')]
    public function render()
    {
        $records = MedicalSchedule::where('user_id', auth()->id())
            ->orderBy('reminder_time', 'asc')
            ->select('id', 'title', 'reminder_time', 'type', 'repeat_interval', 'is_completed', 'description')
            ->paginate(10);

        return view('livewire.medical-schedule.schedule-list', compact('records'));
    }

    public function toggleComplete($id)
    {
        $schedule = MedicalSchedule::findOrFail($id);
        $schedule->is_completed = !$schedule->is_completed;
        $schedule->save();
    }
    
}
