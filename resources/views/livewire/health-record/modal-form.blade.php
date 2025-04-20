<div>
    <h2 class="text-lg font-semibold mb-4">Tambah Catatan {{ $healthType->name }}</h2>

    <form wire:submit.prevent="submit" class="space-y-4">
        <div class="mb-4" wire:key="input-type-{{ $healthType?->id ?? 'default' }}">
            <label for="value" class="block font-semibold mb-1">{{$healthType && $healthType->value_type === 'string' ? 'Masukkan Nilai / keterangan' : 'Masukkan Nilai'}} </label>
        
            @if ($healthType && $healthType->value_type === 'string')
                <textarea wire:model="value" class="w-full border p-2 rounded" placeholder="Masukkan nilai..." rows="4" cols="20"></textarea>
            @else
                <input type="text" wire:model="value" class="w-full border p-2 rounded" placeholder="Contoh: 36.5">
            @endif
        
            @error('value') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        <div class="mb-4">
            <label for="recordedAt">Tanggal Catatan</label>
            <input type="datetime-local" wire:model="recordedAt" class="w-full border p-2 rounded">
            @error('recordedAt') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>
        <div>
            <label class="block text-sm font-medium">Catatan (opsional)</label>
            <textarea wire:model="notes" rows="3" class="w-full rounded border-gray-300 shadow-sm"></textarea>
            @error('notes') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            Simpan
        </button>
        
    </form>
</div>
