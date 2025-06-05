@props([
    'variant' => 'primary', // 'primary', 'outline', 'error'
])

@php
$base = 'inline-flex items-center px-4 py-2 border rounded-md font-semibold text-xs uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150';

$styles = [
    'primary' => 'bg-primary text-white hover:bg-secondary-4 border-transparent focus:ring-primary',
    'outline' => 'bg-transparent text-primary border-primary hover:bg-primary hover:text-white focus:ring-primary',
    'error' => 'bg-red-600 text-white hover:bg-red-700 border-transparent focus:ring-red-500',
];
@endphp

<button {{ $attributes->merge(['type' => 'button', 'class' => "$base " . (array_key_exists($variant, $styles) ? $styles[$variant] : $styles['primary'])]) }}>
    {{ $slot }}
</button>