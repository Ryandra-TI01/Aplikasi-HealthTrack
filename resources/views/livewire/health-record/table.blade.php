<div class="space-y-4">

    {{-- TABLE SECTION --}}
    <div class="overflow-x-auto rounded-lg shadow">
        <table class="min-w-full divide-y divide-gray-200 bg-white text-sm text-left">
            <thead class="bg-indigo-50 text-indigo-700 text-xs uppercase tracking-wider">
                <tr>
                    <th class="px-4 py-3 font-semibold">No</th>
                    <th class="px-4 py-3 font-semibold cursor-pointer" wire:click="sortBy('recorded_at')">
                        Date
                        @if ($sortField === 'recorded_at')
                            @if ($sortDirection === 'asc') ↑ @else ↓ @endif
                        @endif
                    </th>
                    <th class="px-4 py-3 font-semibold cursor-pointer" wire:click="sortBy('value')">
                        Value
                        @if ($sortField === 'value')
                            @if ($sortDirection === 'asc') ↑ @else ↓ @endif
                        @endif
                    </th>
                    <th class="px-4 py-3 font-semibold">Notes</th>
                    <th class="px-4 py-2 text-left">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 text-gray-700">
                @forelse($records as $record)
                    <tr class="hover:bg-gray-50 transition duration-200">
                        <td class="px-4 py-3">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3">{{ \Carbon\Carbon::parse($record->recorded_at)->format('d M Y') }}</td>
                        <td class="px-4 py-3">{{ $record->value ?? $record->raw_value }}</td>
                        <td class="px-4 py-3">{{ $record->notes ?? '-' }}</td>
                        <td class="px-4 py-2 space-x-2">
                            <x-secondary-button 
                                class="text-blue-600 hover:underline"
                                x-on:click="$dispatch('edit-record', { id: {{ $record->id }} })"
                            >
                                Edit
                            </x-secondary-button>
                            
                            {{-- Component Confirm Delete --}}
                            {{-- <livewire:health-record.confirm-delete :record-id="$record->id" wire:key="delete-{{ $record->id }}"/> --}}
                            <livewire:components.confirm-delete
                                :record-id="$record->id"
                                :model-class="\App\Models\HealthRecord::class"
                                :model-name="'Health Record'"
                                wire:key="delete-{{ $record->id }}" 
                            />

                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-auto py-6 text-center text-gray-500">Tidak ada data.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- PAGINATION --}}
    <div class="mt-4">
        {{ $records->links() }}
    </div>
</div>

