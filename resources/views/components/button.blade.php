@props([
    'variant' => 'primary', // 'primary', 'outline', 'error'
    'type' => 'button',     // 'button', 'submit', 'reset'
    'fullWidth' => false,   // true = w-full, false = auto width
])

@php
$base = 'text-center px-4 py-2 border rounded-md font-semibold text-xs capitalize tracking-widest focus:outline-none focus:ring-2 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150 transition-all duration-300 hover:scale-105 hover:shadow-lg';

$styles = [
    'primary' => 'bg-primary text-white hover:bg-secondary-4 border-transparent focus:ring-primary',
    'outline' => 'bg-transparent text-primary border-primary hover:bg-primary hover:text-white focus:ring-primary',
    'error' => 'bg-red-600 text-white hover:bg-red-700 border-transparent focus:ring-red-500',
    'cancel' => 'bg-gray-6/50 text-gray-3 hover:bg-gray-6/20 border-transparent focus:ring-gray-6/50',
];

// Tambahkan w-full jika fullWidth true
$widthClass = $fullWidth ? 'w-full' : '';
@endphp

<button {{ $attributes->merge([
    'type' => $type,
    'class' => "$base " . (isset($styles[$variant]) ? $styles[$variant] : $styles['primary']) . " $widthClass"
]) }}>
    {{ $slot }}
</button>