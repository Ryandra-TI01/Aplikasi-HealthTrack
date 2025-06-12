@props([
    'value' => '',
    'colors' => [], // Array custom warna per value
    'defaultColor' => 'bg-gray-100 text-gray-800', // Fallback
])

@php
    $color = $colors[$value] ?? $defaultColor;
@endphp

<span class="px-2 py-1 text-xs font-semibold rounded-full {{ $color }}">
    {{ ucfirst(str_replace('_', ' ', $value)) }}
</span>
