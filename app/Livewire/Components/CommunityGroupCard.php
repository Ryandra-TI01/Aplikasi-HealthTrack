<?php

namespace App\Livewire\Components;

use App\Models\CommunityGroup;
use Livewire\Component;

class CommunityGroupCard extends Component
{
public $group;
    public $selectedGroup = null;
    public $showGroupModal = false;

    public function showGroup($groupId)
    {
        $this->selectedGroup = CommunityGroup::find($groupId);
        $this->showGroupModal = true;
    }

    public function closeModal()
    {
        $this->showGroupModal = false;
    }

    public function render()
    {
        return view('livewire.components.community-group-card');
    }
}
