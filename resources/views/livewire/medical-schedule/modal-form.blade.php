<x-modal wire:model="show" title="Tambah Jadwal Medis" maxWidth="md">
    <form wire:submit.prevent="save" class="flex flex-col max-h-[90vh] overflow-hidden bg-white rounded shadow-lg w-full max-w-lg">
        
        {{-- Header --}}
        <div class="shrink-0 px-6 pt-6">
            <h2 class="text-xl font-semibold text-primary text-center">
                {{ $scheduleId ? 'Edit Your Schedule' : 'Submit Your Schedule' }}
            </h2>
            <p class="text-sm text-center text-gray-600 mt-1 mb-4">
                {{ $scheduleId ? 'Please update your schedule details clearly to help you stay on track.' : 'Please fill in your schedule details clearly to help you stay on track.' }}
            </p>
        </div>

        {{-- Form Fields (scrollable) --}}
        <div class="overflow-y-auto grow px-6 pb-4 space-y-4">
            <div>
                <x-label for="title" class="block text-sm">Title</x-label>
                <x-input type="text" wire:model.live="title" name="title" />
                @error('title') <small class="text-red-500">{{ $message }}</small> @enderror
            </div>

            <div>
                <x-label for="type" class="block text-sm">Schedule Type</x-label>
                <x-select wire:model.live="type" name="type">
                    <option value="">--  Select Schedule Types --</option>
                    <option value="medicine">Medicine</option>
                    <option value="consultation">Consultation</option>
                    <option value="lab test">Lab Test</option>
                    <option value="therapy and sports">Therapy and Sports</option>
                </x-select>
                @error('type') <small class="text-red-500">{{ $message }}</small>@enderror
            </div>

            <div>
                <x-label for="reminder_time" class="block text-sm">Date Time</x-label>
                <x-input type="datetime-local" wire:model.live="reminder_time" name="reminder_time" />
                @error('reminder_time') <small class="text-red-500">{{ $message }}</small> @enderror
            </div>

            <div>
                <x-label for="description" class="block text-sm">Description</x-label>
                <x-textarea wire:model.live="description" name="description" ></x-textarea>
            </div>

            <div>
                <x-label for="repeat_interval" class="block text-sm">Repeat Interval</x-label>
                <x-select wire:model.live="repeat_interval" name="repeat_interval">
                    <option value="">--  Select Repeat Options  --</option>
                    <option value="none">None</option>
                    <option value="daily">Daily</option>
                    <option value="weekly">Weekly</option>
                    <option value="monthly">Monthly</option>
                </x-select>
                @error('repeat_interval') <small class="text-red-500">{{ $message }}</small> @enderror
            </div>

            @if ($is_completed == true)            
                <div class="flex items-center">
                    <x-checkbox type="checkbox" wire:model="is_completed" id="is_completed" name="is_completed" class="mr-2"/>
                    <label for="is_completed">Completed</label>
                </div>
            @endif
        </div>

        {{-- Footer --}}
       <div class="shrink-0 px-6 py-4 flex justify-end gap-2 border-t bg-white">
            <x-button variant="cancel" type="button" wire:click="hideModal">
                Cancel
            </x-button>

            <x-loading-button wire:click="save">
                {{ $scheduleId ? 'Update' : 'Submit' }}
            </x-loading-button>

        </div>

    </form>
</x-modal>
