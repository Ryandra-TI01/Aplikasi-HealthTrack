<?php

namespace App\Livewire\Ui;

use Livewire\Attributes\On;
use Livewire\Component;

class Toast extends Component
{
    public $show = false;
    public $message = '';
    public $type = 'info';
    #[On('notify')] 
    public function showNotification($type, $message)
    {
        $this->type = $type;
        $this->message = $message;
        $this->show = true;
    }

    public function close()
    {
        $this->show = false;
    }

    public function render()
    {
        return view('livewire.ui.toast');
    }
}
