<div>
    {{-- Breadcrumb navigation showing user location in the app --}}
    <livewire:components.breadcrumbs :items="[
            ['label' => 'Health Monitoring', 'url' => route('health-records.index')],
            ['label' => 'Download Monitoring', 'url' => route('health-records.download')]
        ]" 
    />

    {{-- Page header with title and description --}}
    <livewire:components.page-header 
        title="Download Your Health Data" 
        description="Export your health monitoring records for personal use or to share with your doctor." 
    />

    {{-- Filter Card --}}
    <div class="bg-white sm:border sm:shadow-md sm:rounded-xl p-6 mt-6">
        <form action="{{ route('monitoring.export') }}" method="GET" class="grid gap-4">
            {{-- Row 1 --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                {{-- Health Data Type --}}
                <div>
                    <x-label for="type" value="Select Data Type"></x-label>
                    <x-input wire:click="$dispatch('showTypeModal')"
                        id="type"
                        name="type"
                        value="{{ count($selectedTypes) > 0 ? implode(', ', $healthTypes->whereIn('id', $selectedTypes)->pluck('name')->toArray()) : '-- Select Data Type --' }}"
                        >
                    </x-input>
                    @error('selectedTypes') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                {{-- Start Date --}}
                <div>
                    <x-label for="start_date">Starting Date</x-label>
                    <x-input type="date" name="start_date" wire:model="start_date" value="{{ $start_date }}"/>
                    @error('start_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                {{-- End Date --}}
                <div>
                    <x-label for="end_date" >End Date</x-label>
                    <x-input type="date" name="end_date" wire:model="end_date" value="{{ $end_date }}"/>
                    @error('end_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            {{-- Modal --}}
            <x-modal wire:model="showModal"  maxWidth="lg">
                <div class="p-6 w-full overflow-y-auto max-h-[90vh]">
                    <h2 class="text-primary text-center font-medium mb-6">-- Select Data Type --</h2>
                    
                    <div class="space-y-2">
                        <div class="mb-4">
                            <x-label class="flex items-center gap-2" for="selectAll">
                                <x-checkbox type="checkbox" wire:model.live="selectAll" id="selectAll" />
                                Select All
                            </x-label>
                        </div>

                        @foreach ($healthTypes as $type)
                            <x-label for="{{ $type->id }}" class="flex items-center gap-2">
                                <x-checkbox type="checkbox" name="types[]" id="{{$type->id}}" wire:model.live="selectedTypes" value="{{ $type->id }}"/>
                                {{ $type->name }}
                            </x-label>
                        @endforeach
                    </div>

                    <div class="flex justify-end mt-4 gap-2">
                        <x-button wire:click="cancel" variant="cancel">Cancel</x-button>
                        <x-button wire:click="close">Apply</x-button>
                    </div>
                </div>
            </x-modal>

            {{-- Row 2: Buttons --}}
            <div class="flex justify-end gap-2">
                <x-button type="button" wire:click="showData" wire:target="showData" wire:loading.attr="disabled"  variant="outline" class="flex items-center" wire:target="showData">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"><path d="M3 13c3.6-8 14.4-8 18 0"/><path d="M12 17a3 3 0 1 1 0-6a3 3 0 0 1 0 6"/></g></svg>
                        <span wire:loading.remove wire:target="showData" >Preview</span>
                        <span wire:loading wire:target="showData">Loading...</span>
                </x-button>

                <x-button type="submit" class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="m12 16l-5-5l1.4-1.45l2.6 2.6V4h2v8.15l2.6-2.6L17 11zm-6 4q-.825 0-1.412-.587T4 18v-3h2v3h12v-3h2v3q0 .825-.587 1.413T18 20z"/></svg>
                    <span class="ms-1">
                        Download
                    </span>
                </x-button>
            </div>
        </form>

    </div>

    {{-- Preview Section --}}
    @if ($hasPreviewed && count($selectedTypes) > 0)
        @foreach ($selectedTypes as $typeId)
            @php
                $type = $healthTypes->firstWhere('id', $typeId);
                $records = $results[$typeId] ?? collect();
            @endphp

            <div class="mt-10">
                <h3 class="text-lg font-semibold text-primary mb-4 ms-4 sm:ms-0">Preview {{ $type->name }} Data</h3>

                {{-- Chart --}}
                @if ($records->isNotEmpty())
                    <div 
                        x-data="{
                            chart: null,
                            initChart() {
                                const ctx = document.getElementById('chart-{{ $typeId }}').getContext('2d');
                                this.chart = new Chart(ctx, {
                                    type: 'line',
                                    data: {
                                        labels: @js($records->pluck('recorded_at')->map(fn($d) => \Carbon\Carbon::parse($d)->format('d M'))->toArray()),
                                        datasets: [{
                                            label: '{{ $type->unit }}',
                                            data: @js($records->map(fn($r) => $r->value ?? $r->raw_value)->toArray()),
                                            borderColor: '#2D805A',
                                            backgroundColor: '#2D805A',
                                            tension: 0.4,
                                            pointRadius: 5,
                                            pointBackgroundColor: '#2D805A'
                                        }]
                                    },
                                    options: {
                                        responsive: true,
                                        plugins: {
                                                legend: { display: true },
                                                title: {
                                                    display: true,
                                                    text: 'Grafik {{ $type->name }}',
                                                    font: {
                                                        size: 18,
                                                        weight: 'bold'
                                                    },
                                                    color: '#2D805A', // Tailwind slate-800
                                                    padding: {
                                                        top: 10,
                                                        bottom: 20
                                                    }
                                                }
                                            }
                                    }
                                });
                            }
                        }"
                        x-init="initChart()"
                        class="bg-white sm:rounded-xl sm:shadow sm:p-4 mb-6 sm:border border-primary"
                        wire:ignore
                    >
                        <canvas id="chart-{{ $typeId }}" class="w-full h-64"></canvas>
                    </div>
                @endif

                {{-- Table --}}
                <div class="bg-white shadow sm:rounded-xl w-full overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase whitespace-nowrap">Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase whitespace-nowrap">Time</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase whitespace-nowrap">Value</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase whitespace-nowrap">Notes</th>
                                {{-- <th class="px-6 py-3 text-left text-xs font-medium uppercase whitespace-nowrap">Actions</th> --}}
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100">
                            @if ($records->isEmpty())
                                <tr>
                                    <td colspan="5" class="px-6 py-6 text-center text-gray-500">No data found.</td>
                                </tr>
                            @endif

                            @foreach ($records as $record)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ \Carbon\Carbon::parse($record->recorded_at)->format('d M Y') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ \Carbon\Carbon::parse($record->recorded_at)->format('h:i A') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $record->value ?? $record->raw_value }} {{ $type->unit }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $record->notes ?? '-' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        @endforeach
    @else
        <p class="text-gray-500 text-sm mt-6 p-4 sm:p-0">Please select health data and date range, then click Preview.</p>
    @endif

    {{-- Footer note with a thank you message to users --}}
    <livewire:components.footer-note 
        title="Accurate records for informed decisions."
        description="- Share it with your doctor or keep it for your health journey -"
    />

</div>

