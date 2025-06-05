<?php

namespace App\Livewire\Support;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.support.index')->layout('layouts.app');
    }
}
