<div 
    x-data="{ show: @entangle('visible') }"
    x-cloak
>
    <div
        x-show="show"
        class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40"
    >
        <div
            x-show="show"
            x-transition:enter="transition ease-out duration-100"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-100"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="w-full max-w-sm rounded-xl p-6 shadow-lg text-center bg-white"
        >
            <!-- Icon -->
            <div class="mb-4">
                <img 
                    src="{{ asset($type === 'success' ? 'images/success.png' : 'images/failed.png') }}" 
                    alt="Status" 
                    class="w-12 h-12 mx-auto"
                >
            </div>

            <!-- Title -->
            <h2 class="text-lg font-bold mb-2 text-{{ $type === 'success' ? 'green' : 'red' }}-700">
                {{ $title }}
            </h2>

            <!-- Message -->
            <p class="text-sm mb-4 text-{{ $type === 'success' ? 'green' : 'red' }}-600">
                {{ $message }}
            </p>

            <!-- OK Button -->
            <x-button
                wire:click="close"
                @click="show = false"
                variant="{{$type=== 'success'? 'primary' : 'error'}}" 
            >
                OK
            </x-button>
        </div>
    </div>
</div>

<style>
    [x-cloak] { display: none; }
</style>
