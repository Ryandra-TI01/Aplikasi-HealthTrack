<div class="p-4 space-y-4">
    <h2>Unduhan Monitoring Kesehatan</h2>

    <div class="flex gap-4">    
        <form action="{{ route('monitoring.export') }}" method="GET" target="_blank">
            <label> Start Date </label>
            <input type="date" name="start_date" wire:model="startDate" value="{{ $startDate }}">
            @error('startDate') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

            <label> End Date </label>
            <input type="date" name="end_date" wire:model="endDate" value="{{ $endDate }}">
            @error('endDate') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

            @foreach ($healthTypes as $type)
                <label>
                    <input type="checkbox" name="types[]" wire:model="selectedTypes" value="{{ $type->id }}"
                        {{ in_array($type->id, $selectedTypes ?? []) ? 'checked' : '' }}>
                    {{ $type->name }}
                </label>
            @endforeach

            <button type="submit">Unduh PDF</button>
        </form>

    </div>
    <button wire:click="showData" class="bg-blue-500 text-white px-4 py-2 rounded">Show Data</button>

    @foreach ($selectedTypes as $typeId)
        @php
            $type = $healthTypes->firstWhere('id', $typeId);
            $records = $results[$typeId] ?? collect();
        @endphp

        <div class="mt-6">
            <h3>{{ $type->name }} ({{ $type->unit }})</h3>

            @if($records->isEmpty())
                <p class="text-sm text-gray-500">No data available.</p>
            @else
                <table class="table-auto border mt-2 w-full">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border px-4 py-2">Date</th>
                            <th class="border px-4 py-2">Value</th>
                            <th class="border px-4 py-2">Notes</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($records as $record)
                            <tr>
                                <td class="border px-4 py-2">{{ $record->recorded_at }}</td>
                                <td class="border px-4 py-2">{{ $record->value ?? $record->raw_value }} {{ $type->unit }}</td>
                                <td class="border px-4 py-2">{{ $record->notes ?? '-' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            @endif
        </div>
    @endforeach
</div>
