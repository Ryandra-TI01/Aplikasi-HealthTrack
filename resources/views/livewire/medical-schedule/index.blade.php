<div>
    <livewire:components.breadcrumbs :items="[
            ['label' => 'Schedule', 'url' => route('medical-schedule.index')]
        ]" 
    />
    <livewire:components.page-header 
        title="Your Schedule" 
        description="Here your upcoming schedule." 
    />

    {{-- toggle view --}}
    <div class="inline-flex items-center rounded-lg overflow-hidden border border-gray-300 shadow-sm mb-4 ms-4 sm:ms-0">
        {{-- List Button --}}
        <button wire:click="setView('list')"
            class="flex items-center gap-1 px-4 py-2 transition-all duration-150
                {{ $viewMode === 'list' ? 'bg-primary text-white' : 'bg-white text-gray-600 hover:bg-gray-100' }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" class="fill-current" viewBox="0 0 48 48">
                <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="4"
                    d="m5 10l3 3l6-6M5 24l3 3l6-6M5 38l3 3l6-6m7-11h22M21 38h22M21 10h22"/>
            </svg>
            <span class="text-sm font-medium"></span>
        </button>
        
        {{-- Calendar Button --}}
        <button wire:click="setView('calendar')"
            class="flex items-center gap-1 px-4 py-2 transition-all duration-150
                {{ $viewMode === 'calendar' ? 'bg-primary text-white' : 'bg-white text-gray-600 hover:bg-gray-100' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g class="calendar-outline"><g fill="currentColor" class="Vector"><path fill-rule="evenodd" d="M6 4h12a4 4 0 0 1 4 4v10a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8a4 4 0 0 1 4-4m0 2a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2z" clip-rule="evenodd"/><path fill-rule="evenodd" d="M3 10a1 1 0 0 1 1-1h16a1 1 0 1 1 0 2H4a1 1 0 0 1-1-1m5-8a1 1 0 0 1 1 1v4a1 1 0 0 1-2 0V3a1 1 0 0 1 1-1m8 0a1 1 0 0 1 1 1v4a1 1 0 1 1-2 0V3a1 1 0 0 1 1-1" clip-rule="evenodd"/><path d="M8 13a1 1 0 1 1-2 0a1 1 0 0 1 2 0m0 4a1 1 0 1 1-2 0a1 1 0 0 1 2 0m5-4a1 1 0 1 1-2 0a1 1 0 0 1 2 0m0 4a1 1 0 1 1-2 0a1 1 0 0 1 2 0m5-4a1 1 0 1 1-2 0a1 1 0 0 1 2 0m0 4a1 1 0 1 1-2 0a1 1 0 0 1 2 0"/></g></g></svg>
            <span class="text-sm font-medium"></span>
        </button>


    </div>

    @if($viewMode === 'calendar')
        <div class="bg-white rounded-none sm:rounded-xl sm:shadow-md p-4 sm:border">
            <livewire:medical-schedule.schedule-calendar />
        </div>
    @else
        <div class="bg-white rounded-none sm:rounded-xl sm:shadow-md p-4 sm:border">
            {{-- Top bar --}}
            <div class="flex flex-col md:flex-row items-center justify-between gap-4 mb-6">
                <x-input type="text" wire:model.live="search" icon :placeholder="__('Search')" />
    
                <div class="flex gap-3">
                    <x-button variant="cancel" wire:click="resetFilter">
                        Reset Filter
                    </x-button>
                    <button wire:click="$dispatch('openFilterModal')"
                       class="px-2 py-1 text-sm bg-white border border-primary text-primary font-medium rounded-md hover:bg-primary hover:text-white transition">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.5 7h15M7 12h10m-7 5h4"/></svg>
                    </button>
    
                    <x-button 
                        {{-- x-data @click="$dispatch('open-modal', { id: 'add-health-data' })" --}}
                        wire:click="$dispatch('openScheduleForm')"
                        >
                        Add Schedule
                    </x-button>
                </div>
            </div>
          
    
            {{-- Component Schedule List --}}
            <livewire:medical-schedule.schedule-list 
                :search="$search"
                :filter-type="$filterType"
                :filter-completed="$filterCompleted"
                :filter-date-start="$filterDateStart"
                :filter-date-end="$filterDateEnd"
            />
    
            {{-- Filter Modal --}}  
            <x-modal wire:model="showFilterModal" maxWidth="md">
                <div class="bg-white p-6 rounded-xl w-full max-w-md shadow-xl">
                    <h3 class="text-lg font-semibold mb-4 text-primary">Filter Schedule</h3>
    
                    <div class="mb-3">
                        <x-label for="type" class="text-sm">Type</x-label>
                        <x-select wire:model="filterType" id="type" class="w-full mt-1 border-gray-300 rounded-md">
                            <option value="">All</option>
                            <option value="medicine">Medicine</option>
                            <option value="consultation">Consultation</option>
                            <option value="lab test">Lab Test</option>
                            <option value="therapy and sports">Therapy and Sports</option>
                        </x-select>
                    </div>
    
                    <div class="mb-3">
                        <x-label for="status" class="text-sm">Status</x-label>
                        <x-select wire:model="filterCompleted" id="status" class="w-full mt-1 border-gray-300 rounded-md">
                            <option value="">All</option>
                            <option value="1">Completed</option>
                            <option value="0">Not Completed</option>
                        </x-select>
                    </div>
    
                    <div class="mb-3">
                        <x-label for="dateRange" class="text-sm">Date Range</x-label>
                        <div class="flex gap-2">
                            <x-input type="date" wire:model="filterDateStart"/>
                            <x-input type="date" wire:model="filterDateEnd"/>
                        </div>
                    </div>
    
                    <div class="flex justify-end mt-4 gap-2">
                        <x-button wire:click="$dispatch('closeFilterModal')" variant="cancel">Cancel</x-button>
                        <x-button wire:click="applyFilter">Apply</x-button>
                    </div>
                </div>
            </x-modal>
    
            {{-- Component Modal --}}
            <livewire:medical-schedule.modal-form wire:model="show"/>
        </div>
    @endif


    <livewire:components.footer-note 
        title="Stay on Track with Your Health"
        description="- Keep everything in check—see what’s next on your wellness journey. -"
    />

</div>

