<div class="mx-4 sm:mx-0">
    @if ($medicineReminders->count() > 0 || $appointmentReminders->count() > 0)
        <section class="mb-10 grid grid-cols-1 md:grid-cols-2 gap-6">

            {{-- Reminder Obat --}}
            @foreach ($medicineReminders as $reminder)
                <div class="bg-primary/10 shadow-md hover:shadow-xl rounded-xl p-4 transform-gpu transition-all duration-300 hover:scale-[1.02] hover:-translate-y-1 group cursor-pointer">
                    <h3 class="font-semibold text-sm mb-2 flex items-center text-primary">
                        <img src="{{ asset('images/medicine.png') }}" alt="" class="h-8 mr-2">
                        Medicine Reminder
                    </h3>
                    <p class="text-sm text-gray-700 mb-3">
                        Don't forget: {{ $reminder->title ?? 'No title' }} 
                        at {{ \Carbon\Carbon::parse($reminder->reminder_time)->calendar() }}
                    </p>

                    <div class="flex gap-2 flex-wrap">
                        <x-button wire:click="markDone({{ $reminder->id }})">Done</x-button>
                        <x-button variant="outline" wire:click="openModal({{ $reminder->id }})">Remind me later</x-button>
                        {{-- <livewire:components.confirm-delete
                            :record-id="$reminder->id"
                            :model-class="\App\Models\MedicalSchedule::class"
                            :model-name="'reminder'"
                            wire:key="delete-{{ $reminder->id }}"
                        /> --}}
                    </div>
                </div>
            @endforeach

            {{-- Reminder Janji Temu --}}
            @foreach ($appointmentReminders as $reminder)
                <div class="bg-primary/10 shadow-md hover:shadow-xl rounded-xl p-4 transform-gpu transition-all duration-300 hover:scale-[1.02] hover:-translate-y-1 group cursor-pointer">
                    <h3 class="font-semibold text-sm mb-2 flex items-center text-primary">
                        <img src="{{ asset('images/medicine.png') }}" alt="" class="h-8 mr-2">
                        Appointment Reminder
                    </h3>
                    <p class="text-sm text-gray-700 mb-3">
                        Don't forget: {{ $reminder->title ?? 'No title' }} 
                        at {{ \Carbon\Carbon::parse($reminder->reminder_time)->calendar() }}
                    </p>
                    <div class="flex gap-2 flex-wrap">
                        <x-button wire:click="markDone({{ $reminder->id }})">Done</x-button>
                        <x-button variant="outline" wire:click="openModal({{ $reminder->id }})">Remind me later</x-button>
                </div>
            @endforeach

        </section>
    @else
        <div class="bg-primary/10 text-primary shadow-md rounded-xl p-4 text-center mb-10">No reminders found</div>
    @endif
    <x-modal wire:model="showModal" maxWidth="md">
        <div class="bg-white p-6 w-full">
            <h3 class="text-lg font-bold text-primary mb-4">Remind Me Later</h3>

            {{-- Pilih jenis pengingat --}}
            <x-label for="presetDelay" class="block text-sm mb-1">Choose reminder delay:</x-label>
            <x-select wire:model.live="presetDelay" id="presetDelay" class="form-select w-full mb-4">
                <option value="5">In 5 minutes</option>
                <option value="10">In 10 minutes</option>
                <option value="15">In 15 minutes</option>
                <option value="custom">Pick specific time</option>
            </x-select>

            {{-- Custom datetime jika dipilih --}}
            @if ($presetDelay === 'custom')
                <x-label for="customDateTime" class="block text-sm mb-1">Pick date and time:</x-label>
                <x-input 
                    type="datetime-local" 
                    wire:model.live="customDateTime" 
                    id="customDateTime"
                    class="form-input w-full mb-4"
                />
            @endif

            <div class="flex justify-end gap-2">
                <x-button variant="cancel" wire:click="$set('showModal', false)" class="text-sm text-gray-500">Cancel</x-button>
                <x-button wire:click="remindLater">Confirm</x-button>
            </div>
        </div>
    </x-modal>

</div>