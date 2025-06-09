<?php

namespace App\Livewire\Components;

use Livewire\Attributes\On;
use Livewire\Component;

class Alert extends Component
{
    public $visible = false;
    public $type = 'success'; // success, error, etc.
    public $title = '';
    public $message = '';

    #[On('show-alert')]
    public function showAlert($data)
    {
        $this->type = $data['type'] ?? 'success';
        $this->title = $data['title'] ?? 'Notice';
        $this->message = $data['message'] ?? '';
        $this->visible = true;
    }

    public function close()
    {
        $this->visible = false;
    }

    public function render()
    {
        return view('livewire.components.alert');
    }
}
