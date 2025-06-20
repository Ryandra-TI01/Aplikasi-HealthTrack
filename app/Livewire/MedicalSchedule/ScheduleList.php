<?php

namespace App\Livewire\MedicalSchedule;

use App\Models\MedicalSchedule;
use Livewire\Attributes\Modelable;
use Livewire\Attributes\On;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class ScheduleList extends Component
{
    public $deletingId;
    // #[Modelable]
    #[Reactive]
    public $search, $filterDateStart, $filterDateEnd, $filterCompleted, $filterType;
    
    #[On('medical-schedule-deleted')]
    #[On('medical-schedule-added')]
    public function render()
    {
       $query = MedicalSchedule::where('user_id', auth()->id());

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('title', 'ilike', '%' . $this->search . '%')
                ->orWhere('type', 'ilike', '%' . $this->search . '%');

                if (strtotime($this->search)) {
                    $date = date('Y-m-d', strtotime($this->search));
                    $q->orWhereDate('reminder_time', $date);
                }
            });
        }


        if ($this->filterType) {
            $query->where('type', $this->filterType);
        }

        if ($this->filterCompleted !== '') {
            $query->where('is_completed', $this->filterCompleted);
        }

        if ($this->filterDateStart && $this->filterDateEnd) {
            $query->whereBetween('reminder_time', [$this->filterDateStart, $this->filterDateEnd]);
        }

        return view('livewire.medical-schedule.schedule-list', [
            'all' => $query->orderBy('is_completed')->orderByDesc('reminder_time')->get(),
        ]);
    }
  
    public function toggleComplete($id)
    {
        $schedule = MedicalSchedule::findOrFail($id);
        $schedule->is_completed = !$schedule->is_completed;
        $schedule->save();
    }
    
}
