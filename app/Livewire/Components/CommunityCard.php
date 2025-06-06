<?php

namespace App\Livewire\Components;

use App\Models\CommunityGroup;
use Livewire\Component;

class CommunityCard extends Component
{
    public $centered= false;
    public function render()
    {
        $groups = CommunityGroup::paginate(8);
        return view('livewire.components.community-card', compact('groups'));
    }
}
