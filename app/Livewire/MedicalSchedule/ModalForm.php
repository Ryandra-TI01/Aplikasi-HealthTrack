<?php

namespace App\Livewire\MedicalSchedule;

use App\Models\MedicalSchedule;
use Livewire\Attributes\On;
use Livewire\Component;

class ModalForm extends Component
{
    public $show = false; 
    public $scheduleId = null;
    public $title = '';
    public $description = '';
    public $reminder_time = '';
    public $type = '';
    public $repeat_interval = '';
    public $is_completed = false;
    
    public function render()
    {
        return view('livewire.medical-schedule.modal-form');
    }
    #[On('open-modal')]
    public function showModal()
    {
        $this->resetForm();
        $this->show = true;
    }

    public function hideModal()
    {
        $this->show = false;
    }

    #[On('edit-schedule')]
    public function loadSchedule($id)
    {
        $this->show = true;

        $schedule = MedicalSchedule::findOrFail($id);

        $this->scheduleId = $schedule->id;
        $this->title = $schedule->title;
        $this->description = $schedule->description;
        $this->reminder_time = $schedule->reminder_time;
        $this->type = $schedule->type;
        $this->repeat_interval = $schedule->repeat_interval;
        $this->is_completed = $schedule->is_completed;
        $this->dispatch('modal-data-ready');

    }

    public function resetForm()
    {
        $this->reset([
            'scheduleId',
            'title',
            'description',
            'reminder_time',
            'type',
            'repeat_interval',
            'is_completed',
        ]);
    }

    public function save()
    {
        $validated = $this->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:medicine,appointment',
            'description' => 'nullable|string',
            'reminder_time' => 'required|date',
            'repeat_interval' => 'required|in:none,daily,weekly,monthly',
        ]);

        if ($this->scheduleId) {
            MedicalSchedule::where('id', $this->scheduleId)->update([
                ...$validated,
                'is_completed' => $this->is_completed,
            ]);
            $this->dispatch('notify', type: 'success', message: 'Jadwal berhasil diperbarui!');
        } else {
            MedicalSchedule::create([
                ...$validated,
                'user_id' => auth()->id(),
                'is_completed' => $this->is_completed,
            ]);
            $this->dispatch('notify', type: 'success', message: 'Jadwal berhasil ditambahkan!');
        }

        $this->dispatch('medical-schedule-added');
        $this->hideModal();
        $this->resetForm();
    }
}
