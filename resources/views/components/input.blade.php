@props(['name' => null, 'placeholder' => '', 'disabled' => false, 'icon' => null])

<div class="relative">
    <input
        name="{{ $name }}"
        placeholder="{{ $placeholder }}"
        {{ $disabled ? 'disabled' : '' }}
        {!! $attributes->merge([
            'class' => 'border border-gray-300 rounded-lg pl-4 pr-10 py-2 w-full shadow-sm focus:border-primary focus:ring-primary ' .
                ($errors->has($name) ? 'border-red-500 focus:border-red-500 focus:ring-red-500' : '')
        ]) !!}
    />

    @if ($icon)    
    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M21 21l-4.35-4.35M17 11a6 6 0 11-12 0 6 6 0 0112 0z" />
        </svg>
    </div>
    @endif
</div>

{{-- <x-validation-errors field="{{ $name }}" class="mt-2" /> --}}