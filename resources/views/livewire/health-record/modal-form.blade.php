<x-modal wire:model="showModal" maxWidth="md">
    <form wire:submit.prevent="submit" class="bg-white shadow p-6 md:p-8 w-full">
        <h2 class="text-xl md:text-2xl font-semibold text-primary text-center">
            Submit Health Data
            </h2>
            <p class="text-sm text-center text-gray-600 mt-1 mb-6">
                Please enter your health data accurately for effective monitoring.
            </p>
        <div class="mb-4" wire:key="input-type-{{ $healthType?->id ?? 'default' }}">
            <x-label for="value" class="block font-semibold mb-1">{{$healthType && $healthType->value_type === 'string' ? 'Masukkan Nilai / keterangan' : 'Masukkan Nilai'}} </x-label>
        
            @if ($healthType && $healthType->value_type === 'string')
                <x-textarea wire:model="value" class="w-full border p-2 rounded" placeholder="Masukkan nilai..." rows="4" cols="20"></x-textarea>
            @else
                <x-input type="text" wire:model="value" class="w-full border p-2 rounded" placeholder="Contoh: 36.5"/>
            @endif
        
            @error('value') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        <div class="mb-4">
            <x-label for="recordedAt">Tanggal Catatan</x-label>
            <x-input type="datetime-local" wire:model="recordedAt" class="w-full border p-2 rounded"/>
            @error('recordedAt') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>
        <div>
            <x-label for="notes" class="block text-sm font-medium">Catatan (opsional)</x-label>
            <x-textarea wire:model="notes" rows="3" class="w-full rounded border-gray-300 shadow-sm"></x-textarea>
            @error('notes') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        {{-- Actions --}}
        <div class="flex gap-4 justify-end mt-2">
            <x-button type="button"
                wire:click="cancel"
                variant="cancel">
                Cancel
            </x-button>

            <x-button type="submit" wire:click="submit">
                Submit
            </x-button>
        </div>
    </form>
</x-modal>
