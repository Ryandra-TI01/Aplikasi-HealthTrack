@props([
    'type' => 'submit',
    'method' => null, // Nama method Livewire, contoh: "submitForm"
    'variant' => 'primary',
    'fullWidth' => false,
])

@php
    $target = $method ?? $attributes->whereStartsWith('wire:click')->first()
        ? Str::of($attributes->whereStartsWith('wire:click')->first())->after('wire:click="')->before('"')
        : 'submit';

    $buttonClass = 'relative flex items-center justify-center'; // HAPUS gap-2!
@endphp

<x-button
    :variant="$variant"
    :type="$type"
    :fullWidth="$fullWidth"
    wire:loading.attr="disabled"
    wire:target="{{ $target }}"
    {{ $attributes->merge(['class' => $buttonClass]) }}
>
    {{-- Spinner loading di tengah tombol --}}
    <div
        wire:loading
        wire:target="{{ $target }}"
        class="flex items-center justify-center"
    >
        <div class="w-5 h-5 border-2 border-white border-t-transparent rounded-full animate-spin"></div>
    </div>

    {{-- Teks tombol hanya tampil saat tidak loading --}}
    <span wire:loading.remove wire:target="{{ $target }}">
        {{ $slot }}
    </span>
</x-button>
