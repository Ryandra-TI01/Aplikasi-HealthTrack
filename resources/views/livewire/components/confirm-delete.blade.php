<div x-data="{ confirmDelete: @entangle('confirmDelete') }">
    <!-- Tombol Delete -->
    @if ($icon)
        <svg 
            @click="confirmDelete.open = true"
            wire:loading.class="opacity-50 cursor-not-allowed"
            wire:loading.attr="disabled"
            class="cursor-pointer text-error hover:text-error/50" 
            xmlns="http://www.w3.org/2000/svg" 
            width="24" 
            height="24" 
            viewBox="0 0 24 24">
            <path fill="currentColor" d="M19 4h-3.5l-1-1h-5l-1 1H5v2h14M6 19a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V7H6z"/>
            <span wire:loading wire:target="deleteRecord" class="ml-1 animate-spin">⏳</span>

        </svg>
    @else
        <x-button 
            @click="confirmDelete.open = true"
            wire:loading.class="opacity-50 cursor-not-allowed"
            wire:loading.attr="disabled"
            variant="error"
            >
            Delete
            <span wire:loading wire:target="deleteRecord" class="ml-1 animate-spin">⏳</span>
        </x-button>
    @endif

    <!-- Refactored Modal -->
    <x-modal wire:model="confirmDelete.open" maxWidth="md">
        <div class="relative p-6">
            <!-- Close Icon -->
            <button
                @click="confirmDelete.open = false"
                wire:click="cancelDelete"
                class="absolute top-4 right-4 text-gray-600 hover:text-gray-800"
            >
                <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <!-- Title -->
            <h2 class="text-lg font-semibold text-primary mb-2">Delete {{ $modelName }}</h2>

            <!-- Message -->
            <p class="text-gray-700 mb-6">Are you sure you want to permanently delete this {{ $modelName }}?</p>

            <!-- Buttons -->
            <div class="flex justify-end space-x-4">
                <x-button type="button"
                          wire:click="cancelDelete"
                          @click="confirmDelete.open = false"
                          variant="cancel">
                    Cancel
                </x-button>

                <x-button type="button"
                          wire:click="deleteRecord"
                          wire:loading.class="opacity-50 cursor-not-allowed"
                          wire:loading.attr="disabled"
                          class="bg-green-700 hover:bg-green-800 text-white">
                    Yes
                    <span wire:loading wire:target="deleteRecord" class="ml-1 animate-spin">⏳</span>
                </x-button>
            </div>
        </div>
    </x-modal>
</div>
