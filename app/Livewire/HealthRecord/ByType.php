<?php

namespace App\Livewire\HealthRecord;

use App\Models\HealthRecord;
use App\Models\HealthType;
use Carbon\Carbon;
use Livewire\Attributes\On;
use Livewire\Component;

class ByType extends Component
{
    public $typeId;
    public $healthType;
    public $records = [];
    public bool $showModal = false;
    public $chartRefreshKey;
    public string $search = '';
    public string $sortBy = 'latest';
    public bool $showCustomDateModal = false;
    public $startDate;
    public $endDate;
    public bool $showFilterModal = false;
    public $editingRecord = null;
    public $editValue;
    public $editNotes;
    public $editRecordedAt;

    #[On('openModal')]
    public function create()
    {
        $this->dispatch('reset-form'); 
        $this->editingRecord = null;
        $this->showModal = true; 
    }

    #[On('healthDataType-updated')]
    public function close()
    {
        $this->dispatch('reset-form');
        $this->showModal = false;
        
    }

    public function updatedSearch()
    {
        $this->loadRecords();
    }

    public function applyCustomDateFilter()
    {
        $this->showCustomDateModal = false;
        $this->loadRecords();
    }

    public function applyCustomFilter()
    {
        $this->validate([
            'startDate' => 'required|date',
            'endDate' => 'required|date|after_or_equal:startDate',
        ]);

        $this->loadRecords();
        $this->showFilterModal = false;
    }

    public function updatedSortBy()
    {
        if ($this->sortBy === 'custom') {
            $this->showCustomDateModal = true;
        } else {
            $this->loadRecords();
        }
    }
    public function mount($typeId)
    {
        $this->typeId = $typeId;
        $this->healthType = HealthType::findOrFail($typeId);
        $this->chartRefreshKey = now()->timestamp; // inisialisasi awal
        $this->loadRecords();
    }

    public function edit($recordId)
    {
        $this->editingRecord = HealthRecord::where('user_id', auth()->id())->findOrFail($recordId);
        $this->editValue = $this->editingRecord->value;
        $this->editNotes = $this->editingRecord->notes;
        $this->editRecordedAt = Carbon::parse($this->editingRecord->recorded_at)->format('Y-m-d\TH:i'); // for datetime-local input
        $this->showModal = true;
    }

    public function updateRecord()
    {
        $this->validate([
            'editValue' => $this->healthType->value_type === 'decimal' ? 'required|numeric' : 'required|string|max:255',
            'editRecordedAt' => 'required|date',
        ]);

        $this->editingRecord->update([
            'value' => $this->healthType->value_type === 'decimal' ? $this->editValue : null,
            'raw_value' => $this->healthType->value_type === 'string' ? $this->editValue : null,
            'notes' => $this->editNotes,
            'recorded_at' => $this->editRecordedAt,
        ]);

        $this->showModal = false;
        $this->editingRecord = null;
        $this->dispatch('show-alert', [
            'type' => 'success',
            'title' => 'Success',
            'message' => 'Your health data has been updated.',
        ]);
        $this->dispatch('scrollToTop');
        $this->dispatch('healthDataType-updated');
    }
    
     #[On('healthDataType-updated')]    
     #[On('healthdatatype-deleted')]
    public function refreshChart()
    {
        $this->showModal = false;
        $this->loadRecords();
        $this->chartRefreshKey = now()->timestamp; // trigger re-render chart
    }


    #[On('healthdatatype-deleted')]
    public function loadRecords()
    {
        $query = HealthRecord::query()
            ->where('health_type_id', $this->typeId)
            ->where('user_id', auth()->id());

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('value', 'like', "%{$this->search}%")
                  ->orWhere('notes', 'like', "%{$this->search}%");
            });
        }

        if ($this->sortBy === 'latest') {
            $query->orderByDesc('recorded_at');
        } elseif ($this->sortBy === 'oldest') {
            $query->orderBy('recorded_at');
        } elseif ($this->sortBy === 'custom' && $this->startDate && $this->endDate) {
            $query->whereBetween('recorded_at', [
                Carbon::parse($this->startDate)->startOfDay(),
                Carbon::parse($this->endDate)->endOfDay(),
            ]);
        }

        $this->records = $query->get();
    }

    public function render()
    {
        return view('livewire.health-record.by-type')->layout('layouts.app');
    }
}
