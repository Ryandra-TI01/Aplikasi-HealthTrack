@props(['disabled' => false, 'name'=>null])

<input
    name="{{ $name }}"
    {{ $disabled ? 'disabled' : '' }}
    {!! $attributes->merge([
        'class' => 'border-gray-300 focus:border-primary focus:ring-primary rounded-md shadow-sm ' .
        ($errors->has($name) ? 'border-red-500 focus:border-red-500 focus:ring-red-500' : '')
    ]) !!}
/>
{{-- <x-validation-errors field="{{ $name }}" class="mt-2" /> --}}