@props([
    'disabled' => false,
    'name' => null,
    'rows' => 3,
    'placeholder' => '',
])

<textarea
    name="{{ $name }}"
    id="{{ $attributes->get('id') ?? $name }}"
    rows="{{ $rows }}"
    placeholder="{{ $placeholder }}"
    {{ $disabled ? 'disabled' : '' }}
    {!! $attributes->merge([
        'class' => 'w-full border rounded-md shadow-sm px-4 py-2 resize-none ' .
        'focus:outline-none focus:ring-2 focus:border-transparent ' .
        ($errors->has($name)
            ? 'border-red-500 focus:ring-red-500'
            : 'border-gray-300 focus:border-primary focus:ring-primary')
    ]) !!}
></textarea>
