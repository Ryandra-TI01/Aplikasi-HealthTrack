<?php

namespace App\Livewire\Home\Reminders;

use App\Models\MedicalSchedule;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Reminders extends Component
{
    public $medicineReminders = [];
    public $appointmentReminders = [];

    public $showModal = false;
    public $reminderId = null;
    public $presetDelay = '10'; // default dropdown value
    public $customDelay = null;
    public $customDateTime = null;


    public function mount()
    {
        $this->loadReminders();
    }

    public function loadReminders()
    {
        $now = Carbon::now();
        $userId = Auth::id();

        $this->medicineReminders = MedicalSchedule::query()
            ->where('user_id', $userId)
            ->where('type', 'medicine')
            ->where('is_completed', false)
            // ->where('reminder_time', '<=', $now)
            ->orderBy('reminder_time')
            ->limit(1)
            ->get();

        $this->appointmentReminders = MedicalSchedule::query()
            ->where('user_id', $userId)
            ->where('type', 'appointment')
            ->where('is_completed', false)
            // ->where('reminder_time', '<=', $now)
            ->orderBy('reminder_time')
            ->limit(1)
            ->get();
    }

    public function markDone($id)
    {
        $schedule = MedicalSchedule::findOrFail($id);
        $schedule->update([
            'is_completed' => true,
        ]);

        $this->dispatch('show-alert', [
            'type' => 'success',
            'title' => 'Success',
            'message' => 'Schedule has been completed',
        ]);

        $this->loadReminders();
    }

    public function openModal($id)
    {
        $this->reminderId = $id;
        $this->presetDelay = '10';
        $this->customDelay = null;
        $this->showModal = true;
    }

    public function remindLater()
{
    $schedule = MedicalSchedule::find($this->reminderId);
    if (!$schedule) return;

    if ($this->presetDelay === 'custom') {
        $schedule->reminder_time = Carbon::parse($this->customDateTime);
    } else {
        $minutes = (int) $this->presetDelay;
        $schedule->reminder_time = Carbon::parse($schedule->reminder_time)->addMinutes($minutes);
    }

    $schedule->save();

    $this->reset(['showModal', 'reminderId', 'presetDelay', 'customDateTime']);
    $this->loadReminders();
}


    public function render()
    {
        return view('livewire.home.reminders.reminders');
    }
}
