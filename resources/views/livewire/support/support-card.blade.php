<div class="rounded-xl p-8 flex items-center gap-4 shadow-md flex-col {{ $bgColor }}">
    <img src="{{ asset($icon) }}" alt="icon" class="w-16 h-auto">
    <div class="text-center">
        <h2 class="text-xl font-semibold {{ $textColorTitle }}">{{ $title }}</h2>
        <p class="text-sm {{ $textColorDescription }}">{{ $description }}</p>
        <x-button variant="{{ $buttonVariant }}" class="mt-3">
            <a href="{{ $buttonLink}}">
                {{ $buttonText }}
            </a>
        </x-button>
    </div>
</div>
