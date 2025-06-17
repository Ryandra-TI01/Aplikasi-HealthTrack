<div>
    <!-- Card -->
    <div class="bg-primary/10 rounded-xl max-w-44 w-full shadow-md p-6 flex flex-col items-center text-center hover:shadow-xl transform-gpu transition-all duration-300 hover:scale-[1.02] hover:-translate-y-1 group cursor-pointer ">
        <img src="{{ str_contains($group->group_link, 'wa.me') 
                        ? asset('images/whatsapp.png') 
                        : (str_contains($group->group_link, 't.me') 
                        ? asset('images/telegram.png') 
                        : asset('images/default-community.png')) }}" 
            alt="{{ $group->name }}" class="w-12 h-12 object-contain mb-4">
        <h3 class="font-semibold text-sm mb-2 text-primary">{{ $group->name }}</h3>
        <x-button wire:click="showGroup({{ $group->id }})"
            class="bg-primary hover:bg-secondary-4 text-white text-sm px-4 py-2 rounded shadow mt-auto">
            Visit Group
        </x-button>
    </div>

    <!-- Modal with custom component -->
    <x-modal wire:model="showGroupModal" maxWidth="sm" class="h-full">
        @if($selectedGroup)
        <div class="relative px-6 py-8">
            <button class="absolute top-2 right-3 text-gray-600 text-xl" wire:click="closeModal">×</button>
            <div class="text-center">
                <img src="{{ str_contains($selectedGroup->group_link, 'wa.me') 
                            ? asset('images/whatsapp.png') 
                            : (str_contains($selectedGroup->group_link, 't.me') 
                            ? asset('images/telegram.png') 
                            : asset('images/default.png')) }}" 
                    alt="{{ $selectedGroup->name }}" class="w-24 h-24 mx-auto mb-4">
                <h3 class="text-lg font-semibold text-primary">{{ $selectedGroup->name }}</h3>
                <small class="text-[12px] font-thin italic text-gray3 mb-2 block">Group created on {{ \Carbon\Carbon::parse($selectedGroup->created_at)->format('F d, Y') }}</small>
                <p class="text-sm text-gray-700 mb-4">{{ $selectedGroup->description }}</p>
                <x-button>
                    <a href="{{ $selectedGroup->group_link }}" target="_blank">
                        Join Now
                    </a>
                </x-button>
            </div>
        </div>
        @endif
    </x-modal>
</div>
