<?php

namespace App\Livewire\Community;

use App\Models\CommunityGroup;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.community.index')->layout('layouts.app');
    }
}
