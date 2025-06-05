<?php

namespace App\Livewire\Components;

use Livewire\Component;

class FooterNote extends Component
{
    public $title = 'Still need more help?';
    public $description = 'We’re always ready to support you. Reach out to us to get assistance or ask anything.';
    
    public function render()
    {
        return view('livewire.components.footer-note');
    }
}
