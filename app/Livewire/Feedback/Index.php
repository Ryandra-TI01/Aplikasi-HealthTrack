<?php

namespace App\Livewire\Feedback;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.feedback.index')->layout('layouts.app');
    }
}
