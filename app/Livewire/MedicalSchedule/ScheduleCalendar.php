<?php

namespace App\Livewire\MedicalSchedule;

use App\Models\MedicalSchedule;
use Carbon\Carbon;
use Livewire\Component;

class ScheduleCalendar extends Component
{
    public $currentMonth;
    public $currentYear;
    public $allSchedules = [];

    public ?string $selectedDate = null;
    public bool $showDateModal = false;
    public array $selectedSchedules = [];

    public function mount()
    {
        $now = now();
        $this->currentMonth = $now->month;
        $this->currentYear = $now->year;

        $this->loadSchedules();
    }

    public function updated($field)
    {
        if (in_array($field, ['currentMonth', 'currentYear'])) {
            $this->loadSchedules();
        }
    }

    public function loadSchedules()
    {
        $this->allSchedules = MedicalSchedule::where('user_id', auth()->id())
            ->where(function ($query) {
                $query->whereMonth('reminder_time', $this->currentMonth)
                    ->whereYear('reminder_time', $this->currentYear)
                    ->orWhereIn('repeat_interval', ['daily', 'weekly', 'monthly']);
            })
            ->get();
    }

    public function render()
    {
        $daysInMonth = Carbon::create($this->currentYear, $this->currentMonth)->daysInMonth;
        $firstDay = Carbon::create($this->currentYear, $this->currentMonth, 1)->dayOfWeek;

        return view('livewire.medical-schedule.schedule-calendar', [
            'daysInMonth' => $daysInMonth,
            'firstDay' => $firstDay,
            'allSchedules' => $this->allSchedules,
        ]);
    }

    public function selectDate($date)
    {
        $this->selectedDate = $date;

        $carbonDate = Carbon::parse($date);
        $this->selectedSchedules = collect($this->allSchedules)->filter(function ($item) use ($carbonDate) {
            $scheduleDate = Carbon::parse($item->reminder_time);

            return match ($item->repeat_interval) {
                'none' => $scheduleDate->isSameDay($carbonDate),
                'daily' => true,
                'weekly' => $scheduleDate->dayOfWeek === $carbonDate->dayOfWeek,
                'monthly' => $scheduleDate->day === $carbonDate->day,
                default => false,
            };
        })->values()->all();

        $this->showDateModal = true;
    }
}
