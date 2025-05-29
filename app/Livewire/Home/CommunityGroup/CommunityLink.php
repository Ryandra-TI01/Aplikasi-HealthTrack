<?php

namespace App\Livewire\Home\CommunityGroup;

use App\Models\CommunityGroup;
use Livewire\Component;

class CommunityLink extends Component
{
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
        $groups = CommunityGroup::all()->take(5);
        return view('livewire.home.community-group.community-link', compact('groups'));
    }
}
