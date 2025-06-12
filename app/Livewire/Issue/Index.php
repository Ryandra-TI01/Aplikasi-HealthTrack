<?php

namespace App\Livewire\Issue;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.issue.index')->layout('layouts.app');
    }
}
