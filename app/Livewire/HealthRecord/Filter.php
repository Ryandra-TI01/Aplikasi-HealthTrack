<?php

namespace App\Livewire\HealthRecord;

use Livewire\Component;

class Filter extends Component
{
    public string $search = '';
    public ?string $startDate = null;
    public ?string $endDate = null;

    public function resetFilter()
    {
        $this->search = '';
        $this->startDate = null;
        $this->endDate = null;

        $this->dispatch('filterUpdated', [
            'search' => $this->search,
            'startDate' => $this->startDate,
            'endDate' => $this->endDate,
        ]);
    }
    public function updated()
    {
        $this->dispatch('filterUpdated', [
            'search' => $this->search,
            'startDate' => $this->startDate,
            'endDate' => $this->endDate,
        ]);
    }
    public function render()
    {
        return view('livewire.health-record.filter');
    }
}
