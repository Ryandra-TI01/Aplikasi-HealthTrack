<div class="space-y-6">
    {{-- Search, Sort, Add --}}
    <div class="flex flex-col md:flex-row items-center sm:justify-between gap-4 p-2 sm:p-0">
        <div class="flex items-center gap-2 md:w-auto">
            <x-input
                type="text"
                wire:model.live="search"
                placeholder="Search"
                icon
                class="md:w-64"
            />
            <x-select wire:model.live="sortBy">
                <option value="latest">Sort by Latest</option>
                <option value="oldest">Sort by Oldest</option>
            </x-select>
        </div>
        <x-button wire:click="openModal">Add Issue</x-button>
    </div>

    {{-- Table --}}
    <div class="overflow-x-auto sm:rounded-lg sm:shadow">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-primary text-white">
                <tr>
                    <th class="px-6 py-3 text-left font-semibold">Title</th>
                    <th class="px-6 py-3 text-left font-semibold">Status</th>
                    <th class="px-6 py-3 text-left font-semibold">Created&nbsp;At</th>
                    <th class="px-6 py-3 text-left font-semibold">Action</th>
                </tr>
            </thead>
            <tbody class="">
                @forelse ($issues as $issue)
                    <tr
                        class="{{ $loop->index % 2 === 0 ? 'bg-white' : 'bg-primary/5' }} hover:bg-gray-200 cursor-pointer transition"
                        wire:click="show({{ $issue->id }})"
                    >
                        <td class="px-6 py-4">{{ $issue->title }}</td>
                        <td class="px-6 py-4">
                            <x-badge
                                :value="$issue->status"
                                :colors="[
                                    'resolved'    => 'bg-green-100 text-green-800',
                                    'in_progress' => 'bg-blue-100 text-blue-800',
                                    'open'        => 'bg-red-100  text-gray-800',
                                ]"
                            />
                        </td>
                        <td class="px-6 py-4">{{ $issue->created_at->diffForHumans() }}</td>
                        <td class="px-6 py-4">
                            <x-button wire:click.stop="confirmDelete({{ $issue->id }})" variant="error">Delete</x-button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                            No issues found.
                        </td>
                    </tr>
                @endforelse
            </tbody>

        </table>
    </div>

    {{-- Modal Create --}}
    <x-modal wire:model="showModal" maxWidth="md">
        <div class="relative px-6 py-8">
            <button
                class="absolute top-2 right-3 text-gray-600 text-xl"
                wire:click="closeModal">
                <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <h2 class="text-xl md:text-2xl font-semibold text-primary text-center">Report an Issue</h2>
            <p class="text-sm text-center text-gray-600 mt-1 mb-6">
                Please describe the issue so we can fix it as soon as possible.
            </p>

            <form wire:submit.prevent="submit" class="space-y-4">
                <div>
                    <x-label for="title" value="Title" />
                    <x-input id="title" type="text" wire:model.live="title" />
                    @error('title') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>

                <div>
                    <x-label for="description" value="Description" />
                    <x-textarea id="description" wire:model.live="description" />
                    @error('description') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>

                <div class="flex justify-end gap-2 pt-2">
                    <x-button variant="cancel" type="button" wire:click="closeModal">Cancel</x-button>
                    <x-button variant="primary" type="submit">Submit</x-button>
                </div>
            </form>
        </div>
    </x-modal>

    {{-- Modal Detail --}}
    <x-modal wire:model="showDetailModal" maxWidth="md">
        @if($selectedIssue) {{-- gunakan property yg dikirim dari render --}}
            <div class="relative px-6 py-8">
                <button
                    class="absolute top-2 right-3 text-xl ring-0 focus:outline-none"
                    wire:click="closeDetailModal">
                    <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                <h2 class="text-xl md:text-2xl font-semibold text-primary text-center">Issue Details</h2>

                <div class="mt-4 space-y-3 text-sm text-gray-700">
                    <div><span class="font-semibold">Title:</span> {{ $selectedIssue->title }}</div>
                    <div><span class="font-semibold">Description:</span> {{ $selectedIssue->description }}</div>
                    <div>
                        <span class="font-semibold">Status:</span>
                        <x-badge :value="$selectedIssue->status" :colors="[
                            'resolved'    => 'bg-green-100 text-green-800',
                            'in_progress' => 'bg-blue-100 text-blue-800',
                            'open'        => 'bg-red-100  text-gray-800',
                        ]" />
                    </div>
                    <div>
                        <span class="font-semibold">Created At:</span>
                        {{ $selectedIssue->created_at->toDayDateTimeString() }}
                    </div>
                    <div>
                        <span class="font-semibold">Response:</span>
                        {{ $selectedIssue->response ?: '-' }}
                    </div>
                </div>
            </div>
        @endif
    </x-modal>

    {{-- Modal Delete --}}
    <x-modal wire:model="showConfirmModal" maxWidth="md">
        <div class="relative p-6">
            <!-- Tombol Close -->
            <button
                wire:click="cancelDelete"
                class="absolute top-4 right-4 text-gray-600 hover:text-gray-800"
            >
                <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <!-- Judul Modal -->
            <h2 class="text-lg font-semibold text-primary mb-2">Confirm Delete</h2>

            <!-- Pesan -->
            <p class="text-gray-700 mb-6">Are you sure you want to delete this issue? This action cannot be undone.</p>

            <!-- Aksi -->
            <div class="flex justify-end space-x-4">
                <x-button wire:click="cancelDelete" variant="cancel">
                    Cancel
                </x-button>

                <x-button
                    wire:click="deleteIssue"
                    wire:loading.class="opacity-50 cursor-not-allowed"
                    wire:loading.attr="disabled"
                    variant="error"
                >
                    Delete
                    <span wire:loading wire:target="deleteIssue" class="ml-1 animate-spin">⏳</span>
                </x-button>
            </div>
        </div>
    </x-modal>

</div>


