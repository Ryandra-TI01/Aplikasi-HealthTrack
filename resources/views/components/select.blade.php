@props(['name' => null, 'disabled' => false])

<select
    name="{{ $name }}"
    {{ $disabled ? 'disabled' : '' }}
    {!! $attributes->merge([
        'class' => 'border border-gray-300 rounded-lg py-2 w-full shadow-sm focus:border-primary focus:ring-primary ' .
            ($errors->has($name) ? 'border-red-500 focus:border-red-500 focus:ring-red-500' : '')
    ]) !!}
>
    {{ $slot }}
</select>
