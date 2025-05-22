<div class="space-y-4">
    @foreach ($records as $record)
        <div class="bg-white border shadow rounded-lg p-4 flex justify-between items-start">
            <div class="flex-1">
                <h3 class="text-lg font-semibold text-gray-800">
                    {{ $record->title }}
                </h3>
                <p class="text-sm text-gray-600 mb-1">
                    {{ \Carbon\Carbon::parse($record->reminder_time)->translatedFormat('d F Y, H:i') }}
                </p>
                <p class="text-gray-500 text-sm">{{ $record->description }}</p>
                <div class="mt-2 flex gap-2 flex-wrap text-xs">
                    <span class="bg-blue-100 text-blue-700 px-2 py-0.5 rounded">
                        Jenis: {{ ucfirst($record->type) }}
                    </span>
                    <span class="bg-purple-100 text-purple-700 px-2 py-0.5 rounded">
                        Pengulangan: {{ $record->repeat_interval ?: '-' }}
                    </span>
                    <span class="px-2 py-0.5 rounded 
                        {{ $record->is_completed ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                        Status: {{ $record->is_completed ? 'Selesai' : 'Belum Selesai' }}
                    </span>
                </div>
            </div>

            <div class="flex flex-col items-end gap-2 ml-4">
                <div x-data="{ loading: false }">
                    <button
                        @click="loading = true; $wire.toggleComplete({{ $record->id }}).then(() => loading = false)"
                        class="text-sm text-green-600"
                    >
                        <span x-show="!loading">✔️ Tandai {{ $record->is_completed ? 'Belum' : 'Selesai' }}</span>
                        <span x-show="loading">⏳...</span>
                    </button>
                </div>

                <button
                    wire:click="$dispatch('edit-schedule', { id: {{ $record->id }} })"
                    class="text-blue-600 hover:underline text-sm"
                >
                    ✏️ Edit
                </button>
                <livewire:components.confirm-delete
                    :record-id="$record->id"
                    :model-class="\App\Models\MedicalSchedule::class"
                    :model-name="'Medical Schedule'"
                    wire:key="delete-{{ $record->id }}" 
                />
            </div>
        </div>
    @endforeach

    @if ($records->isEmpty())
        <div class="text-center text-gray-400 py-10">
            Belum ada jadwal medis.
        </div>
    @endif
    <div class="mt-4">
        {{ $records->links() }}
    </div>
</div>
