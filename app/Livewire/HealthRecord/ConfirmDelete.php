<?php

namespace App\Livewire\HealthRecord;

use App\Models\HealthRecord;
use Livewire\Attributes\On;
use Livewire\Component;

class ConfirmDelete extends Component
{
    public int $recordId;
    public bool $confirming = false;

    public function confirmDelete()
    {
        $this->confirming = true;
    }

    public function deleteRecord()
    {
        $record = HealthRecord::find($this->recordId);

        if (!$record || $record->user_id !== auth()->id()) {
            abort(403, 'Tidak diizinkan.');
        }

        $record->delete();

        // Biar nanti bisa refresh dari parent atau kasih notifikasi
        $this->dispatch('record-deleted');
        $this->dispatch('scrollToTop');
        $this->dispatch('notify', type: 'success', message: 'Data berhasil dihapus.');
        $this->confirming = false;
    }

    public function render()
    {
        return view('livewire.health-record.confirm-delete');   
    }
}
