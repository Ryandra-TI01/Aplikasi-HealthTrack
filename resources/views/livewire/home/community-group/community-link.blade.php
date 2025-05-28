<div class="mb-10 grid grid-cols-1 md:grid-cols-5 gap-6">
    @foreach($groups as $group)
    <div class="bg-primary/10 rounded-xl shadow-lg p-6 flex flex-col items-center text-center">
        {{-- <div class="bg-gray-200 rounded-xl p-4 mb-4"> --}}
        <img src="{{ str_contains($group->group_link, 'wa.me') 
                        ? asset('images/whatsapp.png') 
                        : (str_contains($group->group_link, 't.me') 
                        ? asset('images/telegram.png') 
                        : asset('images/default.png')) }}" 
            alt="{{ $group->name }}" class="w-12 h-12 object-contain mb-4">

        {{-- </div> --}}
        <h3 class="font-semibold text-sm mb-2 text-primary">{{ $group->name }}</h3>
        <x-button wire:click="showGroup({{ $group->id }})"
            class="bg-primary hover:bg-secondary-4 text-white text-sm px-4 py-2 rounded shadow mt-auto">
            Visit Group
        </x-button>
    </div>
    @endforeach

    <!-- Modal -->
    @if($selectedGroup)
    <div class="fixed inset-0 bg-black/50 flex items-center justify-center z-50">
        <div class="bg-white rounded-xl shadow-lg p-6 max-w-md w-full relative">
            <button class="absolute top-2 right-3 text-gray-600 text-xl" wire:click="closeModal">×</button>
            <div class="text-center">
                <img src="{{ str_contains($selectedGroup->group_link, 'wa.me') 
                            ? asset('images/whatsapp.png') 
                            : (str_contains($selectedGroup->group_link, 't.me') 
                            ? asset('images/telegram.png') 
                            : asset('images/default.png')) }}" 
                alt="{{ $selectedGroup->name }}" class="w-24 h-24 mx-auto mb-4">
                <h3 class="text-xl font-bold mb-1">{{ $selectedGroup->name }}</h3>
                <p class="text-sm italic mb-2">Group created on {{ \Carbon\Carbon::parse($selectedGroup->created_at)->format('F d, Y') }}</p>
                <p class="text-sm text-gray-700 mb-4">{{ $selectedGroup->description }}</p>
                <x-button>
                    <a href="{{ $selectedGroup->group_link }}" target="_blank">
                        Join Now
                    </a>
                </x-button>
            </div>
        </div>
    </div>
    @endif
</div>
