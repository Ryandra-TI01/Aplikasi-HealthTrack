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
        {{-- Header Hari --}}
        <div class="grid grid-cols-4 sm:grid-cols-7 gap-2 text-center text-sm font-semibold text-gray-600 mb-2">
            @foreach (['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'] as $dayName)
                <div>{{ $dayName }}</div>
            @endforeach
        </div>

        {{-- Tanggal --}}
        <div class="grid grid-cols-4 sm:grid-cols-7 gap-2 text-center text-sm">
            @for ($day = 1; $day <= $daysInMonth; $day++)
                @php
                    $carbonDate = \Carbon\Carbon::create($currentYear, $currentMonth, $day);
                    $date = $carbonDate->format('Y-m-d');
                    $isToday = $carbonDate->isToday();
                    $isSelected = isset($selectedDate) && $selectedDate === $date;
                @endphp

                <div
                    class="border rounded-lg p-1 min-h-[70px] text-left cursor-pointer
                        hover:bg-gray-50 hover:scale-[1.02] hover:shadow-sm transition-all duration-150
                        {{ $isToday ? 'bg-primary/10 border-primary border-2' : '' }}
                        {{ $isSelected ? 'bg-indigo-100 border-indigo-400' : '' }}"
                    wire:click="selectDate('{{ $date }}')"
                >
                    {{-- Nomor Hari --}}
                    <div class="font-semibold text-xs text-gray-700 text-center">{{ $day }}</div>

                    {{-- Jadwal --}}
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

                                $badgeClass = match($item->type) {
                                    'medicine' => 'bg-yellow-200 text-yellow-800',
                                    'consultation' => 'bg-green-200 text-green-800',
                                    'lab test' => 'bg-blue-200 text-blue-800',
                                    'therapy and sports' => 'bg-red-200 text-red-800',
                                    default => 'bg-gray-200 text-gray-700',
                                };
                            @endphp

                        @if ($showBadge)
                            <span class="flex items-center gap-1 text-[10px] px-2 py-0.5 rounded-xl shadow-sm truncate max-w-full
                                {{ $badgeClass }}">
                                <x-health-type-icon :type="$item->type" />
                                <span class="truncate">{{ Str::limit($item->title, 20) }}</span>
                            </span>
                        @endif

                        @endforeach
                    </div>
                </div>
            @endfor
        </div>
    </div>


    <x-modal wire:model="showDateModal" maxWidth="lg">
        <div class="bg-white p-6 rounded-lg">
            <h2 class="text-lg font-semibold text-primary mb-4 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g class="calendar-outline"><g fill="currentColor" class="Vector"><path fill-rule="evenodd" d="M6 4h12a4 4 0 0 1 4 4v10a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8a4 4 0 0 1 4-4m0 2a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2z" clip-rule="evenodd"/><path fill-rule="evenodd" d="M3 10a1 1 0 0 1 1-1h16a1 1 0 1 1 0 2H4a1 1 0 0 1-1-1m5-8a1 1 0 0 1 1 1v4a1 1 0 0 1-2 0V3a1 1 0 0 1 1-1m8 0a1 1 0 0 1 1 1v4a1 1 0 1 1-2 0V3a1 1 0 0 1 1-1" clip-rule="evenodd"/><path d="M8 13a1 1 0 1 1-2 0a1 1 0 0 1 2 0m0 4a1 1 0 1 1-2 0a1 1 0 0 1 2 0m5-4a1 1 0 1 1-2 0a1 1 0 0 1 2 0m0 4a1 1 0 1 1-2 0a1 1 0 0 1 2 0m5-4a1 1 0 1 1-2 0a1 1 0 0 1 2 0m0 4a1 1 0 1 1-2 0a1 1 0 0 1 2 0"/></g></g></svg>
                Schedule On
                {{ \Carbon\Carbon::parse($selectedDate)->translatedFormat('j F Y') }}
            </h2>

            @forelse ($selectedSchedules as $schedule)
                @php
                    $badgeClass = match($schedule->type) {
                        'medicine' => 'bg-yellow-100 text-yellow-800',
                        'consultation' => 'bg-green-100 text-green-800',
                        'lab test' => 'bg-blue-100 text-blue-800',
                        'therapy and sports' => 'bg-red-100 text-red-800',
                        default => 'bg-gray-100 text-gray-700',
                    };

                    $time = \Carbon\Carbon::parse($schedule->reminder_time)->format('H:i');
                @endphp

                <div class="flex items-start gap-2 mb-3 p-3 rounded border hover:shadow-md transition cursor-pointer {{ $badgeClass }}">
                    <div class="w-6 h-6">
                        <x-health-type-icon :type="$schedule->type" />
                    </div>
                    <div class="flex-1">
                        <div class="font-semibold text-sm">{{ $schedule->title }}</div>
                        <div class="text-xs text-gray-600">{{ ucfirst($schedule->type) }} &bull; {{ $time }}</div>
                    </div>
                </div>
            @empty
                <p class="text-sm text-gray-500 italic">There are no schedules on this date.</p>
            @endforelse

            <div class="mt-6 flex justify-end">
                <x-button wire:click="$set('showDateModal', false)" variant="cancel">
                    Close
                </x-button>
            </div>
        </div>
    </x-modal>

</div>
