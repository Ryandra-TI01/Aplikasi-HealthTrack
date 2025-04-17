<!-- resources/views/livewire/create-health-record.blade.php -->

<div class="max-w-xl mx-auto mt-10 bg-white p-6 rounded shadow">
    @if (session()->has('message'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="submit">
        <div class="mb-4">
            <label for="healthTypeId" class="block font-semibold mb-1">Tipe Kesehatan</label>
            <select wire:model.live="healthTypeId" class="w-full border-gray-300 rounded p-2">
                <option value="">-- Pilih --</option>
                @foreach ($healthTypes as $type)
                    <option value="{{ $type->id }}">{{ $type->name }} ({{ $type->unit }}) {{$type->value_type}}</option>
                @endforeach
            </select>
            @error('healthTypeId') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4" wire:key="input-type-{{ $selectedHealthType?->id ?? 'default' }}">
            <label for="value" class="block font-semibold mb-1">{{$selectedHealthType && $selectedHealthType->value_type === 'string' ? 'Masukkan Nilai / keterangan' : 'Masukkan Nilai'}} </label>
        
            @if ($selectedHealthType && $selectedHealthType->value_type === 'string')
                <textarea wire:model.live="value" class="w-full border p-2 rounded" placeholder="Masukkan nilai..." rows="4" cols="20"></textarea>
            @else
                <input type="text" wire:model.live="value" class="w-full border p-2 rounded" placeholder="Contoh: 36.5">
            @endif
        
            @error('value') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
    
        <div class="mb-4">
            <label for="recordedAt">Tanggal Catatan</label>
            <input type="datetime-local" wire:model="recordedAt" class="w-full border p-2 rounded">
            @error('recordedAt') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>
        
        <div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Simpan
            </button>
        </div>
    </form>
</div>
