<?php

namespace App\Livewire\Home\Reminders;

use App\Models\MedicalSchedule;
use Auth;
use Carbon\Carbon;
use Livewire\Component;

class Reminders extends Component
{
    public $medicineReminders = [];
    public $appointmentReminders = [];

    public function mount()
    {
        $now = Carbon::now();
        $user = Auth::user();

        $this->medicineReminders = MedicalSchedule::where('user_id', $user->id)
            ->where('type', 'medicine')
            ->where('is_completed', false)
            ->where('reminder_time', '<=', $now)
            ->orderBy('reminder_time')
            ->limit(1)
            ->get();

        $this->appointmentReminders = MedicalSchedule::where('user_id', $user->id)
            ->where('type', 'appointment')
            ->where('reminder_time', '<=', $now)
            ->where('is_completed', false)
            ->orderBy('reminder_time')
            ->limit(1)
            ->get();
    }

    public function markDone($id)
    {
        $schedule = MedicalSchedule::findOrFail($id);
        $schedule->is_completed = !$schedule->is_completed;
        $schedule->save();

        $this->mount();
        
    }

    public function remindLater($id)
    {
        // Misalnya tambahkan 10 menit ke reminder
        $schedule = MedicalSchedule::find($id);
        if ($schedule) {
            $schedule->reminder_time = Carbon::parse($schedule->reminder_time)->addMinutes(10);
            $schedule->save();
            $this->mount(); // refresh data
        }
    }

    // public function skipReminder($id)
    // {
    //     // Bisa dihapus atau ditandai skip
    //     MedicalSchedule::where('id', $id)->update(['skipped' => true]);
    //     $this->mount(); // refresh data
    // }

    public function render()
    {
        return view('livewire.home.reminders.reminders');
    }
}
