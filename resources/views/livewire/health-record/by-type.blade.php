<div>
    {{-- Breadcrumb navigation showing user location in the app --}}
    <livewire:components.breadcrumbs :items="[
            ['label' => 'Health Monitoring', 'url' => route('health-records.index')],
            ['label' => $healthType->name, 'url' => route('health-record.by-type', $healthType->id)]
        ]" 
    />

    {{-- Page header with title and description --}}
    <livewire:components.page-header 
        title="Your Health Progress" 
        description="Comprehensive view of your selected health metric." 
    /> 
    
    {{-- main --}}
    <div>     
        {{-- component chart --}}
        @if ($healthType->value_type === 'decimal')
            {{-- <livewire:health-chart :healthTypeId="$healthType->id" /> --}}
            <livewire:health-chart :healthTypeId="$healthType->id" :wire:key="'chart-'.$healthType->id.'-'.$chartRefreshKey" />

        @endif

        {{-- Top bar --}}
        <div class="flex flex-col md:flex-row items-center justify-between gap-4 mb-6 p-2 sm:p-0">
            <div class="flex gap-3">
                <div class="flex-1">
                    <x-input type="text" icon placeholder="Search" wire:model.live="search"
                        class="w-full" />
                </div>

                {{-- Sort Dropdown --}}
                <div>
                    <x-select wire:model.live="sortBy" class="w-full md:w-48">
                        <option value="latest">Sort: Latest</option>
                        <option value="oldest">Sort: Oldest</option>
                        <option value="custom">Sort: Custom Date</option>
                    </x-select>
                </div>
            </div>

            <x-button wire:click="$dispatch('openModal')">
                Add {{ $healthType->name }}
            </x-button>
        </div>

        {{-- Custom Filter Modal --}}
        <x-modal wire:model="showCustomDateModal" maxWidth="md">
            <form wire:submit.prevent="applyCustomFilter" class="p-6">
                <h2 class="text-lg font-bold text-primary mb-4">Custom Date Filter</h2>

                <div class="mb-4">
                    <x-label for="startDate" value="Start Date" />
                    <x-input type="date" wire:model.defer="startDate" class="w-full" />
                    @error('startDate') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <x-label for="endDate" value="End Date" />
                    <x-input type="date" wire:model.defer="endDate" class="w-full" />
                    @error('endDate') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="flex justify-end gap-2">
                    <x-button type="button" variant="cancel" wire:click="$set('showCustomDateModal', false)">
                        Cancel
                    </x-button>
                    <x-button type="submit">
                        Apply Filter
                    </x-button>
                </div>
            </form>
        </x-modal>

        {{-- Modals --}}
        @if ($showModal)
            @if ($editingRecord)
                {{-- EDIT MODE --}}
                <x-modal wire:model="showModal" maxWidth="md">
                    <form wire:submit.prevent="updateRecord" class="p-6">
                        <h2 class="text-lg font-bold text-primary mb-4">Edit {{ $healthType->name }}</h2>

                        <div class="mb-4">
                            <x-label for="editValue" class="block font-semibold mb-1">{{$healthType && $healthType->value_type === 'string' ? 'Masukkan Nilai / keterangan' : 'Masukkan Nilai'}} </x-label>
                                    
                            @if ($healthType && $healthType->value_type === 'string')
                                <x-textarea wire:model="editValue" class="w-full border p-2 rounded" placeholder="Masukkan nilai..." rows="4" cols="20"></x-textarea>
                            @else
                                <x-input type="text" wire:model="editValue" class="w-full border p-2 rounded" placeholder="Contoh: 36.5"/>
                            @endif
                        
                            @error('value') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-4">
                            <x-label for="notes" value="Notes" />
                            <textarea wire:model="editNotes" class="w-full rounded-md border-gray-300 shadow-sm"></textarea>
                        </div>

                        <div class="mb-4">
                            <x-label for="recorded_at" value="Recorded At" />
                            <x-input type="datetime-local" wire:model="editRecordedAt" class="w-full" />
                            @error('editRecordedAt') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="flex justify-end gap-2">
                            <x-button type="button" variant="cancel" wire:click="$set('showModal', false)">
                                Cancel
                            </x-button>
                            <x-button type="submit">Update</x-button>
                        </div>
                    </form>
                </x-modal>
            @else
                {{-- CREATE MODE --}}
                <livewire:health-record.modal-form
                    :healthTypeId="$healthType->id"
                    wire:model="showModal"
                />
            @endif
        @endif
           

        {{-- Table --}}
<div class="w-full overflow-x-auto sm:rounded-xl sm:shadow">
    <table class="min-w-full text-sm text-left">
        <thead class="bg-primary text-white">
            <tr>
                <th class="px-4 py-3 whitespace-nowrap">Date</th>
                <th class="px-4 py-3 whitespace-nowrap">Time</th>
                <th class="px-4 py-3 whitespace-nowrap">Value</th>
                <th class="px-4 py-3 whitespace-nowrap">Notes</th>
                <th class="px-4 py-3 whitespace-nowrap">Actions</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y">
            @forelse ($records as $record)
                <tr wire:key="record-{{ $record->id }}">
                    <td class="px-4 py-3 whitespace-nowrap">
                        {{ \Carbon\Carbon::parse($record->recorded_at)->format('d M Y') }}
                    </td>
                    <td class="px-4 py-3 whitespace-nowrap">
                        {{ \Carbon\Carbon::parse($record->recorded_at)->format('h:i A') }}
                    </td>
                    <td class="px-4 py-3 whitespace-nowrap">
                        {{ $record->value }} {{ $healthType->unit }}
                    </td>
                    <td class="px-4 py-3 whitespace-nowrap">
                        {{ $record->notes ?: '-' }}
                    </td>
                    <td class="px-4 py-3 whitespace-nowrap">
                        <div class="flex items-center gap-2">
                           {{-- Edit/Delete buttons --}}
                                <button class="text-primary hover:text-primary/50" wire:click="edit({{ $record->id }})"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z"/></g></svg></button>
                                <livewire:components.confirm-delete
                                    :record-id="$record->id"
                                    :model-class="\App\Models\HealthRecord::class"
                                    :model-name="'healthdatatype'"
                                    wire:key="delete-{{$record->id}}"
                                    icon
                                />
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center px-4 py-6 text-gray-500">No health records found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
         
        
    
    <livewire:components.footer-note 
        title="Every health data you track brings you closer to your wellness goals."
        description="- Keep tracking, keep improving -"
    />
</div>

