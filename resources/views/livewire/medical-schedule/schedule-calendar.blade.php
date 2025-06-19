<div>
    {{-- Bulan & Tahun --}}
    <div class="flex flex-wrap gap-4 items-center justify-between mb-4">
        <div class="flex gap-2 w-full sm:w-auto">
            <x-select wire:model.live="currentMonth" class="w-full">
                @for ($m = 1; $m <= 12; $m++)
                    <option value="{{ $m }}">{{ \Carbon\Carbon::create()->month($m)->format('F') }}</option>
                @endfor
            </x-select>
            <x-select wire:model.live="currentYear" class="w-full">
                @for ($y = now()->year - 1; $y <= now()->year + 1; $y++)
                    <option value="{{ $y }}">{{ $y }}</option>
                @endfor
            </x-select>
        </div>
    </div>

    {{-- Kalender --}}
    <div class="overflow-x-auto">
        <div class="grid grid-cols-4 sm:grid-cols-7 gap-2 text-center text-sm">
            @for ($day = 1; $day <= $daysInMonth; $day++)
                @php
                    $carbonDate = \Carbon\Carbon::create($currentYear, $currentMonth, $day);
                    $date = $carbonDate->format('Y-m-d');
                    $isToday = $carbonDate->isToday();
                @endphp

                <div 
                    class="border rounded-lg p-1 min-h-[70px] text-left cursor-pointer hover:bg-gray-100 transition {{ $isToday ? 'bg-primary/10 border-2 border-primary' : '' }}"
                    wire:click="selectDate('{{ $date }}')"
                >
                    <div class="font-medium text-xs text-gray-600 text-center">{{ $day }}</div>

                    <div class="flex flex-col gap-0.5 mt-1">
                        @foreach ($allSchedules as $item)
                            @php
                                $scheduleDate = \Carbon\Carbon::parse($item->reminder_time);
                                $showBadge = match($item->repeat_interval) {
                                    'none' => $scheduleDate->isSameDay($carbonDate),
                                    'daily' => true,
                                    'weekly' => $scheduleDate->dayOfWeek === $carbonDate->dayOfWeek,
                                    'monthly' => $scheduleDate->day === $carbonDate->day,
                                    default => false,
                                };
                            @endphp

                            @if ($showBadge)
                                <span class="text-[10px] px-1 py-0.5 rounded-xl inline-block truncate max-w-full
                                    {{
                                        match($item->type) {
                                            'medicine' => 'bg-yellow-200 text-yellow-800',
                                            'consultation' => 'bg-green-200 text-green-800',
                                            'lab test' => 'bg-blue-200 text-blue-800',
                                            'therapy and sports' => 'bg-red-200 text-red-800',
                                            default => 'bg-gray-200 text-gray-700'
                                        }
                                    }}">
                                    {{ $item->title }}
                                </span>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endfor
        </div>
    </div>

    <x-modal wire:model="showDateModal" maxWidth="lg">
        <div class="bg-white p-6">
            <h2 class="text-lg font-semibold text-primary mb-4">
                Schedules on {{ \Carbon\Carbon::parse($selectedDate)->format('F j, Y') }}
            </h2>

            @forelse ($selectedSchedules as $schedule)
                <div class="mb-2 p-2 border rounded shadow-sm hover:shadow-md cursor-pointer">
                    <div class="text-sm font-medium text-primary">{{ $schedule->title }}</div>
                    <div class="text-xs text-gray-600">{{ $schedule->type }} - {{ \Carbon\Carbon::parse($schedule->reminder_time)->format('H:i') }}</div>
                </div>
            @empty
                <p class="text-sm text-gray-500">No schedule on this date.</p>
            @endforelse

            <div class="mt-4 flex justify-end">
                <x-button wire:click="$set('showDateModal', false)" variant="cancel">Close</x-button>
            </div>
        </div>
    </x-modal>
</div>
