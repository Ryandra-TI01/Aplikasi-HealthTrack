<div class="p-4 w-1/2 mx-auto">
    <h1 class="text-2xl font-bold mb-4">{{ $healthType->name }}</h1>
    <livewire:health-chart :healthTypeId="$healthType->id" />
    <div class="overflow-x-auto rounded-lg shadow">
        <table class="min-w-full divide-y divide-gray-200 bg-white text-sm text-left">
            <thead class="bg-indigo-50 text-indigo-700 text-xs uppercase tracking-wider">
            <tr>
                <th class="px-4 py-3 font-semibold">No</th>
                <th class="px-4 py-3 font-semibold">Date</th>
                <th class="px-4 py-3 font-semibold">Value</th>
                <th class="px-4 py-3 font-semibold">Notes</th>
            </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 text-gray-700">
            @foreach($records as $record)
                <tr class="hover:bg-gray-50 transition duration-200">
                <td class="px-4 py-3">{{ $loop->iteration }}</td>
                <td class="px-4 py-3">{{ \Carbon\Carbon::parse($record->recorded_at)->format('d M Y') }}</td>
                <td class="px-4 py-3">{{ $record->value ?? $record->raw_value }}</td>
                <td class="px-4 py-3">{{ $record->notes ?? '-' }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
