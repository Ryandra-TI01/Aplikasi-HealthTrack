<?php

namespace App\Livewire\Home\HealthGlance;

use App\Models\Issue;
use Auth;
use Livewire\Component;

class LatestIssue extends Component
{
    public $issues = [];

    public function mount()
    {
        $userId = Auth::id();
        $this->issues = Issue::where('user_id', $userId)
            ->latest()
            ->take(3)
            ->get();
    }
    public function render()
    {
        return view('livewire.home.health-glance.latest-issue');
    }
}
