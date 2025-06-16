<div class="space-y-6">
    <div>
        <h2 class="text-primary font-bold text-sm flex items-center gap-1">
        <svg class="text-primary" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="m6.7 18l-5.65-5.65l1.425-1.4l4.25 4.25l1.4 1.4zm5.65 0L6.7 12.35l1.4-1.425l4.25 4.25l9.2-9.2l1.4 1.425zm0-5.65l-1.425-1.4L15.875 6L17.3 7.4z"/></svg>
        All
        </h2>
        @forelse ($all as $record)
            <div class="flex items-start justify-between border-b py-4 px-6" wire:key="schedule-{{ $record->id }}">
                <div class="flex items-start gap-3">
                {{-- Toggle is_completed --}}
                <button
                    wire:click="toggleComplete({{ $record->id }})"
                    class="group w-6 h-6 rounded-full border-2 flex items-center justify-center 
                        transition-all duration-200 ease-in-out
                        {{ $record->is_completed 
                            ? 'border-gray-6 bg-gray-6 hover:bg-primary/10' 
                            : 'border-gray-3 hover:border-primary hover:bg-primary/10' }}"
                    title="Mark as {{ $record->is_completed ? 'incomplete' : 'complete' }}"
                >
                    {{-- ✅ Icon checklist when completed or on hover --}}
                    <svg 
                        xmlns="http://www.w3.org/2000/svg" 
                        class="w-3.5 h-3.5 transition-opacity duration-200 ease-in-out 
                            {{ $record->is_completed ? 'text-white opacity-100' : 'text-primary opacity-0 group-hover:opacity-100' }}" 
                        viewBox="0 0 20 20" fill="currentColor"
                    >
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414L8.414 15 4.293 10.879a1 1 0 111.414-1.414L8.414 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                </button>

                    {{-- Icon Kategori (Dummy untuk sekarang) --}}
                    <div class="mt-1">
                        @if ($record->is_completed)
                            <span class="text-gray-6">
                                <x-health-type-icon :type="$record->type"/>
                            </span>
                        @elseif (\Carbon\Carbon::parse($record->reminder_time)->isPast())
                            <span class="text-error">
                                <x-health-type-icon :type="$record->type"/>
                            </span>
                        @else
                            <span class="text-primary">
                                <x-health-type-icon :type="$record->type"/>
                            </span>
                        @endif
                    </div>

                    <div>
                        {{-- Title & Type --}}
                        <h3 class="font-semibold text-md 
                            {{ $record->is_completed ? 'text-gray-6 line-through' : ($record->reminder_time < now() ? 'text-error' : 'text-primary') }}">
                            {{ $record->title }} — {{ ucfirst($record->type) }}
                        </h3>

                        {{-- Date & Time --}}
                        <p class="text-xs mt-1 {{ $record->is_completed ? 'text-gray-6' : 'text-gray-3' }}">
                            {{ \Carbon\Carbon::parse($record->reminder_time)->translatedFormat('d F Y — H.i') }} WIB
                        </p>
                    </div>
                </div>

                <div class="flex items-center gap-2">
                    {{-- Edit --}}
                    <button
                        wire:click="$dispatch('edit-schedule', { id: {{ $record->id }} })"
                        wire:key="schedule-{{ $record->id }}"
                        class="text-primary hover:text-primary/50"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z"/></g></svg>
                    </button>

                    {{-- Delete --}}
                    <livewire:components.confirm-delete
                        :record-id="$record->id"
                        :model-class="\App\Models\MedicalSchedule::class"
                        :model-name="'Medical Schedule'"
                        wire:key="delete-{{ $record->id }}"
                        icon
                    />
                </div>
            </div>
        @empty
            <p class="text-gray-3 text-sm">Nothing is finished yet.</p>
        @endforelse
    </div>
    
</div>

