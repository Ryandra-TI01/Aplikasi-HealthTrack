<?php

namespace App\Livewire\Components;

use Livewire\Component;

class PageHeader extends Component
{
    public string $title;
    public string $description;
    public function render()
    {
        return view('livewire.components.page-header');
    }
}
