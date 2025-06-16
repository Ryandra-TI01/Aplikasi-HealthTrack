<div>
    <x-modal wire:model="show" title="Tambah Jadwal Medis" maxWidth="md">
        <div class="bg-white p-6 rounded shadow-lg w-full max-w-lg relative">
    
            <h2 class="text-xl font-semibold mb-4 text-primary text-center">
                {{ $scheduleId ? 'Edit Your Schedule' : 'Submit Your Schedule' }}
            </h2>
            <p class="text-sm text-center text-gray-600 mt-1 mb-6">
                {{ $scheduleId ? 'Please update your schedule details clearly to help you stay on track.' : 'Please fill in your schedule details clearly to help you stay on track.' }}
            </p>
    
            <form wire:submit.prevent="save" class="space-y-4">
                <div>
                    <x-label for="title" class="block text-sm">Title</x-label>
                    <x-input type="text" wire:model.live="title" class="w-full border rounded px-2 py-1"/>
                    @error('title') <small class="text-red-500">{{ $message }}</small> @enderror
                </div>
    
                <div>
                    <x-label for="type" class="block text-sm">Schedule Type</x-label>
                    <x-select wire:model.live="type" class="w-full border rounded px-2 py-1">
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
                    <x-input type="datetime-local" wire:model.live="reminder_time" class="w-full border rounded px-2 py-1"/>
                    @error('reminder_time') <small class="text-red-500">{{ $message }}</small> @enderror
                </div>
    
                <div>
                    <x-label for="description" class="block text-sm">Description</x-label>
                    <x-textarea wire:model.live="description" class="w-full border rounded px-2 py-1"></x-textarea>
                </div>
    
                <div>
                    <x-label for="repeat_interval" class="block text-sm">Repeat Interval</x-label>
                    <x-select wire:model.live="repeat_interval" class="w-full border rounded px-2 py-1">
                        <option value="">--  Select Repeat Options  --</option>
                        <option value="none">None</option>
                        <option value="daily">Daily</option>
                        <option value="weekly">Weekly</option>
                        <option value="monthly">Monthly</option>
                    </x-select>
                    @error('repeat_interval') <small class="text-red-500">{{ $message }}</small> @enderror
                </div>
    
                @if ($is_completed == false)            
                    <div class="flex items-center">
                        <x-checkbox type="checkbox" wire:model="is_completed" id="is_completed" class="mr-2"/>
                        <label for="is_completed">Completed</label>
                    </div>
                @endif
    
                <div class="flex justify-end gap-2">
                    <x-button variant="cancel" type="button" wire:click="hideModal">Cancel</x-button>
                    <x-button type="submit" class="btn btn-primary">
                        {{ $scheduleId ? 'Update' : 'Submit' }}
                    </x-button>
                </div>
            </form>
        </div>
    </x-modal>
</div>