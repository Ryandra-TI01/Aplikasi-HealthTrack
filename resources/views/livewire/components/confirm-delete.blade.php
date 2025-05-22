<div>
    <div x-data="{ confirmDelete: @entangle('confirmDelete') }">
        <!-- Tombol Hapus -->
        <button 
            @click="confirmDelete.open = true"
            wire:loading.class="opacity-50 cursor-not-allowed"
            wire:loading.attr="disabled"
            class="text-red-500 hover:text-red-700">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
            <span wire:loading wire:target="deleteRecord" class="ml-1 animate-spin">⏳</span>
        </button>

        <!-- Modal Konfirmasi -->
        <div x-show="confirmDelete.open" x-cloak
            class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
            <div x-show="confirmDelete.open"
                x-transition:enter="transition ease-out duration-100"
                x-transition:enter-start="opacity-0 transform scale-95"
                x-transition:enter-end="opacity-100 transform scale-100"
                x-transition:leave="transition ease-in duration-100"
                x-transition:leave-start="opacity-100 transform scale-100"
                x-transition:leave-end="opacity-0 transform scale-95"
                class="bg-white rounded-lg shadow-xl p-6 w-full max-w-md">
                
                <h2 class="text-lg font-semibold mb-4">Konfirmasi Penghapusan</h2>
                
                <p class="mb-6">Apakah Anda yakin ingin menghapus {{ $modelName }} ini?</p>
                
                <div class="flex justify-end space-x-3">
                    <button 
                        @click="confirmDelete.open = false"
                        wire:click="cancelDelete"
                        class="px-4 py-2 text-gray-600 bg-gray-200 rounded hover:bg-gray-300">
                        Batal
                    </button>
                    
                    <button 
                        wire:click="deleteRecord"
                        wire:loading.class="opacity-50 cursor-not-allowed"
                        wire:loading.attr="disabled"
                        class="px-4 py-2 text-white bg-red-600 rounded hover:bg-red-700">
                        Hapus
                        <span wire:loading wire:target="deleteRecord" class="ml-2 animate-spin">⏳</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <style>
    [x-cloak] { display: none; }
    </style>
</div>