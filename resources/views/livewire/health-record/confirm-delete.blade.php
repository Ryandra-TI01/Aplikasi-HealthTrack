<div x-data="{ show: @entangle('confirming') }" class="inline">
    <x-danger-button @click="$wire.confirmDelete(); show = true">
        Hapus
    </x-danger-button>

    <!-- Konfirmasi -->
    <div x-show="show" x-cloak class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
        <div class="bg-white p-6 rounded-lg shadow-lg max-w-sm w-full text-center">
            <h2 class="text-lg font-semibold mb-4">Yakin ingin menghapus data ini?</h2>
            <div class="flex justify-center gap-4">
                <button 
                    @click="show = false"
                    class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">
                    Batal
                </button>
                <button 
                    @click="$wire.deleteRecord(); show = false"
                    class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                    Hapus
                </button>
            </div>
        </div>
    </div>
</div>
