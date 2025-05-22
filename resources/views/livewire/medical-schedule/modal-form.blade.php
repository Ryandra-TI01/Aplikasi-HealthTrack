<div x-data="{ showModal: $wire.entangle('show').live }">
    <button 
        class="bg-blue-500 text-white px-3 py-1 rounded mb-4"
        x-on:click="$dispatch('open-modal')"
        >
        Tambah Jadwal
    </button>

    <!-- Modal -->
    <div x-show="showModal" x-cloak class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white p-6 rounded shadow-lg w-full max-w-lg relative">

            <h2 class="text-xl font-semibold mb-4">
                {{ $scheduleId ? 'Edit Jadwal Medis' : 'Tambah Jadwal Medis' }}
            </h2>

            <form wire:submit.prevent="save" class="space-y-4">
                <div>
                    <label class="block text-sm">Judul</label>
                    <input type="text" wire:model="title" class="w-full border rounded px-2 py-1">
                    @error('title') <small class="text-red-500">{{ $message }}</small> @enderror
                </div>

                <div>
                    <label class="block text-sm">Jenis</label>
                    <select wire:model.live="type" class="w-full border rounded px-2 py-1">
                        <option value="">-- Pilih --</option>
                        <option value="appointment">Appointment</option>
                        <option value="medicine">Medicine</option>
                    </select>
                    @error('type') <small class="text-red-500">{{ $message }}</small>@enderror
                </div>

                <div>
                    <label class="block text-sm">Waktu Pengingat</label>
                    <input type="datetime-local" wire:model="reminder_time" class="w-full border rounded px-2 py-1">
                    @error('reminder_time') <small class="text-red-500">{{ $message }}</small> @enderror
                </div>

                <div>
                    <label class="block text-sm">Keterangan</label>
                    <textarea wire:model="description" class="w-full border rounded px-2 py-1"></textarea>
                </div>

                <div>
                    <label class="block text-sm">Pengulangan</label>
                    <select wire:model.live="repeat_interval" class="w-full border rounded px-2 py-1">
                        <option value="">-- Pilih --</option>
                        <option value="none">None</option>
                        <option value="daily">Daily</option>
                        <option value="weekly">Weekly</option>
                        <option value="monthly">Monthly</option>
                    </select>
                    @error('repeat_interval') <small class="text-red-500">{{ $message }}</small> @enderror
                </div>

                <div class="flex items-center">
                    <input type="checkbox" wire:model="is_completed" class="mr-2">
                    <label>Sudah Selesai</label>
                </div>

                <div class="flex justify-end gap-2">
                    <button type="submit" class="btn btn-primary">
                        {{ $scheduleId ? 'Update' : 'Simpan' }}
                    </button>
                </div>
            </form>

            <!-- Tombol Tutup -->
            <button @click="showModal = false" class="absolute top-2 right-2 text-gray-600 hover:text-red-500">✕</button>
        </div>
    </div>
</div>
