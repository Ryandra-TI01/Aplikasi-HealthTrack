<div>
    @if ($medicineReminders->count() > 0 || $appointmentReminders->count() > 0)        
    <section class="mb-10 grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach ([$medicineReminders, $appointmentReminders] as $group)
                @foreach ($group as $reminder)
                    <div class="bg-primary/10 shadow-xl rounded-xl p-4">
                        <h3 class="font-semibold text-sm mb-2 flex items-center text-primary">
                            <img src="{{ asset('images/medicine.png') }}" alt="" class="h-8 mr-2">
                            {{ ucfirst($reminder->type) }}
                        </h3>
                        <p class="text-sm text-gray-700 mb-3">
                            Don't forget: {{ $reminder->title ?? 'No title' }} at {{ \Carbon\Carbon::parse($reminder->reminder_time)->format('h:i A') }}
                        </p>
                        <div class="flex gap-2">
                            <button 
                                wire:click="markDone({{ $reminder->id }})" 
                                wire:confirm="Are you sure you want to delete this post?"
                                class="bg-primary hover:bg-secondary-4 text-white px-3 py-1 text-sm rounded shadow">Done</button>
                            <button wire:click="remindLater({{ $reminder->id }})" class="bg-secondary-3 hover:bg-secondary-1 text-primary px-3 py-1 text-sm rounded shadow">Remind me later</button>
                            {{-- <button wire:click="skipReminder({{ $reminder->id }})" class="bg-gray-300 hover:bg-gray-400 px-3 py-1 text-sm rounded">Skip</button> --}}
                        </div>
                    </div>
                @endforeach
            @endforeach
    </section>
    @else
        <div class="bg-primary/10 shadow-xl rounded-xl p-4 text-center mb-10">No reminders found</div>
    @endif
</div>