<?php

namespace App\Livewire\HealthRecord;

use App\Models\HealthRecord;
use Livewire\Attributes\On;
use Livewire\Component;

class Table extends Component
{
    
    public $healthTypeId;
    public string $search = '';
    public ?string $startDate = null;
    public ?string $endDate = null;
    public string $sortField = 'recorded_at';
    public string $sortDirection = 'desc';
    public int $perPage = 15;
    protected $queryString = ['search', 'startDate', 'endDate', 'sortField', 'sortDirection'];

    public function sortBy(string $field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }
    #[On('filterUpdated')]
    public function updateFilter($filters)
    {
        if (is_array($filters)) {
            $this->search = $filters['search'] ?? '';
            $this->startDate = $filters['startDate'] ?? null;
            $this->endDate = $filters['endDate'] ?? null;
        }
    }
    
    #[On('record-added')] 
    #[On('record-deleted')]
    public function render()
    {
        $records = HealthRecord::query()
        ->where('health_type_id', $this->healthTypeId)
        ->when($this->search, fn($q) =>
                $q->where('value', 'like', '%' . $this->search . '%')
            )
            ->when($this->startDate && $this->endDate, fn($q) =>
                $q->whereBetween('recorded_at', [$this->startDate, $this->endDate])
            )
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.health-record.table', compact('records'));
    }

    public $deletingId;

    public function confirmDelete($id)
    {
        $this->deletingId = $id;

        $this->dispatch('open-delete-confirmation');
    }

    public function deleteRecord()
    {
        $record = HealthRecord::findOrFail($this->deletingId);

        // Optional: validasi agar user hanya bisa hapus record miliknya
        if ($record->user_id !== auth()->id() && !$this->deletingId ) {
            abort(403, 'Tidak diizinkan');
        }
        
        $record->delete();
        $this->deletingId = null;
        $this->dispatch('record-deleted');        
        $this->dispatch('scrollToTop');
        $this->dispatch('notify', type: 'success', message: 'Data berhasil dihapus');
    }

}
