<?php

namespace App\Livewire\Issue;

use App\Models\Issue;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class IssueSection extends Component
{
    // --- UI State
    public string $search = '';
    public string $sortBy = 'latest';
    public bool $showModal = false;
    public bool $showDetailModal = false;
    public ?int $selectedIssueId = null;
    // --- Tambahkan di atas class property
    public bool $showConfirmModal = false;
    public ?int $deletingIssueId = null;

    // --- Form Fields
    #[Validate('required|string|min:3|max:255')]
    public string $title = '';

    #[Validate('required|string|min:5|max:255')]
    public string $description = '';

    /* ---------- Listeners ---------- */
    #[On('issue-deleted')]
    public function refreshList(): void
    {
        // Trigger render ulang (otomatis, tidak perlu isi apapun)
    }

    #[On('reset-detail')]
    public function resetInteraction(): void
    {
        $this->resetValidation();
        $this->closeDetailModal();
    }

    /* ---------- Computed ---------- */
    public function getSelectedIssueProperty(): ?Issue
    {
        return $this->selectedIssueId
            ? Issue::find($this->selectedIssueId)
            : null;
    }

    /* ---------- Modal Actions ---------- */
    public function openModal(): void
    {
        $this->resetValidation();
        $this->reset(['title', 'description']);
        $this->showModal = true;
    }

    public function closeModal(): void
    {
        $this->showModal = false;
    }

    public function show(int $id): void
    {
        $this->selectedIssueId = $id;
        $this->showDetailModal = true;
    }

    public function closeDetailModal(): void
    {
        $this->showDetailModal = false;
        $this->selectedIssueId = null;
    }

    /* ---------- Create ---------- */
    public function submit(): void
    {
        $this->validate();

        try {
            Issue::create([
                'title'       => $this->title,
                'description' => $this->description,
                'status'      => 'open',
                'user_id'     => Auth::id(),
            ]);

            $this->reset(['title', 'description', 'showModal']);
            $this->dispatch('show-alert', [
                'type' => 'success',
                'title' => 'Success',
                'message' => 'Issue has been created successfully.',
            ]);
        } catch (\Throwable $th) {
            $this->dispatch('show-alert', [
                'type' => 'error',
                'title' => 'Error',
                'message' => $th->getMessage(),
            ]);
        }
    }

    /* ---------- Delete ---------- */

    // --- Tambahkan method untuk trigger modal
    public function confirmDelete(int $id): void
    {
        $this->deletingIssueId = $id;
        $this->showConfirmModal = true;
    }

    // --- Cancel modal
    public function cancelDelete(): void
    {
        $this->reset(['showConfirmModal', 'deletingIssueId']);
    }

    // --- Proses penghapusan
    public function deleteIssue(): void
    {
        $issue = Issue::where('id', $this->deletingIssueId)
            ->where('user_id', Auth::id())
            ->first();

        if (!$issue) {
            $this->dispatch('show-alert', [
                'type' => 'error',
                'title' => 'Error',
                'message' => 'Issue not found or unauthorized.',
            ]);
            return;
        }

        $issue->delete();

        $this->reset(['showConfirmModal', 'deletingIssueId']);

        $this->dispatch('show-alert', [
            'type' => 'success',
            'title' => 'Deleted',
            'message' => 'Issue deleted successfully.',
        ]);
    }


    /* ---------- Render ---------- */
    public function render()
    {
        $issues = Issue::query()
            ->where('user_id', Auth::id())
            ->when($this->search, fn ($q) => $q->where('title', 'like', '%' . $this->search . '%'))
            ->orderBy('created_at', $this->sortBy === 'latest' ? 'desc' : 'asc')
            ->get();

        return view('livewire.issue.issue-section', [
            'issues' => $issues,
            'selectedIssue' => $this->selectedIssue,
        ]);
    }
}
