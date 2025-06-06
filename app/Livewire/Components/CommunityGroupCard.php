<?php

namespace App\Livewire\Components;

use App\Models\CommunityGroup;
use Livewire\Component;

class CommunityGroupCard extends Component
{
    public $group;
    public $selectedGroup = null;

    public function showGroup($groupId)
    {
        $this->selectedGroup = CommunityGroup::find($groupId);
    }

    public function closeModal()
    {
        $this->selectedGroup = null;
    }
    public function render()
    {
        return view('livewire.components.community-group-card');
    }
}
