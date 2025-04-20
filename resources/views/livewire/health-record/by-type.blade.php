<div class="p-4 w-1/2 mx-auto">
    <h1 class="text-2xl font-bold mb-4">{{ $healthType->name }}</h1>
    @if (session()->has('message'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif    

    <div x-data="{ showModal: false }" @record-added.window="showModal = false">
        <x-button 
            @click="showModal = true">
            Tambah Data {{ $healthType->name }}
        </x-button>
    
        <!-- Modal -->
        <div x-show="showModal" x-cloak class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-lg">
                <!-- Livewire Component -->
                <livewire:health-record.modal-form :healthType="$healthType" />
                <div class="mt-4 text-right">
                    <button 
                        @click="showModal = false"
                        class="text-sm text-red-600 hover:underline">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
        {{-- end modal --}}
    </div> 
   
    @if ($healthType->value_type === 'decimal')
        <livewire:health-chart :healthTypeId="$healthType->id" />
    @endif
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
