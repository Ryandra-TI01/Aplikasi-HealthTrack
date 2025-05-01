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
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 text-gray-700">
                @forelse($records as $record)
                    <tr class="hover:bg-gray-50 transition duration-200">
                        <td class="px-4 py-3">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3">{{ \Carbon\Carbon::parse($record->recorded_at)->format('d M Y') }}</td>
                        <td class="px-4 py-3">{{ $record->value ?? $record->raw_value }}</td>
                        <td class="px-4 py-3">{{ $record->notes ?? '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-6 text-center text-gray-500">Tidak ada data.</td>
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

