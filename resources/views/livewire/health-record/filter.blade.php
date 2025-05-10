<div class="flex flex-col mb-6 md:flex-row md:items-end md:justify-between gap-4 bg-white p-4 rounded-xl shadow">

    {{-- FILTER SECTION --}}
    <div class="flex flex-wrap gap-4 items-center">
        {{-- Search --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Cari Nilai</label>
            <input type="text"
                wire:model.live="search"
                placeholder="Cari nilai..."
                class="border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 w-full text-sm px-3 py-2"
            />
        </div>

        {{-- Start Date --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Dari Tanggal</label>
            <input type="date"
                wire:model.live="startDate"
                class="border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 w-full text-sm px-3 py-2"
            />
        </div>

        {{-- End Date --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Sampai Tanggal</label>
            <input type="date"
                wire:model.live="endDate"
                class="border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 w-full text-sm px-3 py-2"
            />
        </div>

        {{-- Reset Button --}}
        <div class="md:mt-0">
            <x-button
                wire:click="resetFilter"
                class="mt-5 mb-0"
                >
                Reset Filter
            </x-button>
        </div>
    </div>

</div>
