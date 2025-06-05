<?php

namespace App\Livewire\Support;

use Livewire\Component;

class SupportCard extends Component
{
    public string $title;
    public string $description;
    public string $icon;
    public string $bgColor = 'bg-blue-100'; // default
    public string $textColorTitle = 'text-blue-800'; // default
    public string $textColorDescription = 'text-blue-600'; // default
    public string $buttonVariant;
    public string $buttonLink;
    public string $buttonText;

    public function render()
    {
        return view('livewire.support.support-card');
    }
}
