<div>
    {{-- Breadcrumb navigation showing user location in the app --}}
    <livewire:components.breadcrumbs :items="[
            ['label' => 'Health Monitoring', 'url' => route('health-records.index')]
        ]" 
    />

    {{-- Page header with title and description --}}
    <livewire:components.page-header 
        title="Stay on Top of Your Health!" 
        description="Monitor your blood pressure, heart rate, temperature, and blood glucose levels all in one place." 
    />


    {{-- Main section --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8">
        {{-- Top bar --}}
        <div class="flex flex-col md:flex-row items-center justify-between gap-4 mb-6">
            <x-input type="text" wire:model.live="search" icon :placeholder="__('Search')" />

            <div class="flex gap-3">
                <a href="{{ route('health-records.download') }}"
                   class="px-2 py-1 text-sm bg-white border border-primary text-primary font-medium rounded-md hover:bg-primary hover:text-white transition">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="m12 16l-5-5l1.4-1.45l2.6 2.6V4h2v8.15l2.6-2.6L17 11zm-6 4q-.825 0-1.412-.587T4 18v-3h2v3h12v-3h2v3q0 .825-.587 1.413T18 20z"/></svg>
                </a>

                <x-button 
                    {{-- x-data @click="$dispatch('open-modal', { id: 'add-health-data' })" --}}
                    wire:click="$dispatch('openHealthRecordForm')"
                    >
                    Add Health Data
                </x-button>
            </div>
        </div>

        {{-- Health Types --}}
        <div class="bg-white sm:shadow-md sm:rounded-xl p-6 sm:border border-gray-200">
            <h3 class="text-lg font-semibold mb-4 text-center text-primary border-b border-primary pb-2">
                Types of Health Data
            </h3>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @forelse($this->filteredHealthTypes as $type)
                    <a href="{{ route('health-record.by-type', $type->id) }}"
                       class="bg-primary/10 border border-gray-200 rounded-lg p-4 flex flex-col items-center justify-center text-center shadow-md hover:shadow-xl transition hover:scale-[1.02] hover:-translate-y-1">
                        <div class="w-10 h-10 mb-3 bg-primary/20 text-primary flex items-center justify-center rounded-full">
                            {{-- Random icon placeholder --}}
                            <x-health-icon />
                        </div>
                        <div class="text-md font-medium text-primary">{{ $type->name }}</div>
                        <div class="text-xs text-primary">{{ $type->unit }}</div>
                    </a>
                @empty
                    <p class="col-span-4 text-center text-gray-500">No data types found.</p>
                @endforelse
            </div>
        </div>
    </div>

     {{-- Add Health Data Modal --}}
    <x-modal wire:model="showModal" title="Add Health Data" maxWidth="md">
        <form wire:submit.prevent="submit" class="bg-white shadow p-6 md:p-8 w-full">
            <h2 class="text-xl md:text-2xl font-semibold text-primary text-center">
                Submit Health Data
            </h2>
            <p class="text-sm text-center text-gray-600 mt-1 mb-6">
                Please enter your health data accurately for effective monitoring.
            </p>

            <x-label label="Type" for="healthTypeId" value="Health Type" />
            <x-select id="healthTypeId" wire:model.live="healthTypeId" name="health_type_id" class="form-select w-full">
                <option class="text-primary" value="">-- Select Type --</option>
                @foreach($healthTypes as $type)
                    <option class="text-primary" value="{{ $type->id }}">{{ $type->name }} ({{ $type->unit }})</option>
                @endforeach
            </x-select>
            @error('healthTypeId') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

            <x-label label="Recorded At" for="recordedAt" value="Recorded At" />
            <x-input type="datetime-local" wire:model.live="recordedAt" id="recordedAt" name="recordedAt"/>
            @error('recordedAt') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

            @if ($selectedHealthType)            
                <x-label for="value" class="block font-semibold mb-1">{{$selectedHealthType && $selectedHealthType->value_type === 'string' ? 'Enter Value / description' : 'Enter Value'}} </x-label>
                @if ($selectedHealthType && $selectedHealthType->value_type === 'string')
                    <x-textarea wire:model.live="raw_value" placeholder="Enter Description"></x-textarea>
                    @error('raw_value') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                @else
                    <x-input type="text" wire:model.live="value" placeholder="Enter Value" />
                    @error('value') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                @endif
            @endif


            <x-label label="notes" for="notes" value="Notes" />
            <x-textarea wire:model.live="notes" placeholder="Enter Notes"></x-textarea>


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

    {{-- Footer note with a thank you message to users --}}
    <livewire:components.footer-note 
        title="Every health data you track brings you closer to your wellness goals."
        description="- Keep tracking, keep improving -"
    />
</div>
