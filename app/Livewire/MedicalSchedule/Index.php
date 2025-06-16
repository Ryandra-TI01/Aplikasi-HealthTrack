<?php

namespace App\Livewire\MedicalSchedule;

use App\Models\MedicalSchedule;
use Auth;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    public string $viewMode = 'list'; // default bisa 'calendar' atau 'list'
    public $show = false; 
    public $search = '';
    public $filterType = '';
    public $filterCompleted = '';
    public $filterDateStart;
    public $filterDateEnd;
    public $showFilterModal = false;
    #[On('openFilterModal')]
    public function showFilterModal()
    {
        $this->showFilterModal = true;
    }
    #[On('closeFilterModal')]
    public function closeFilterModal()
    {
        $this->showFilterModal = false;
    }
    public function resetFilter()
    {
        // reset filter
        $this->filterType = '';
        $this->filterCompleted = '';
        $this->filterDateStart ;
        $this->filterDateEnd ;

    }
    public function applyFilter()
    {
        $this->showFilterModal = false;
    }

    public function setView(string $mode)
    {
        $this->viewMode = $mode;
    }

    public function render()
    {
        return view('livewire.medical-schedule.index')->layout('layouts.app');
    }


}