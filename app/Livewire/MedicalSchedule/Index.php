<?php

namespace App\Livewire\MedicalSchedule;

use App\Models\MedicalSchedule;
use Auth;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    public function render()
    {
        return view('livewire.medical-schedule.index')->layout('layouts.app');
    }

}