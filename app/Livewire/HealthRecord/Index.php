<?php

namespace App\Livewire\HealthRecord;

use App\Models\HealthRecord;
use App\Models\HealthType;
use Auth;
use Livewire\Component;

class Index extends Component
{
    public $healthTypes;

    public function mount()
    {
        $this->healthTypes = HealthType::all();
    }
    public function render()
    {
        return view('livewire.health-record.index')->layout('layouts.app');
    }
}
