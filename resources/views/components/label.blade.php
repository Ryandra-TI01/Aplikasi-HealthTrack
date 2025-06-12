@props(['value','for'])

<label for="{{ $for }}" {{ $attributes->merge(['class' => 'block font-medium text-sm text-primary mb-2']) }}>
    {{ $value ?? $slot }}
</label>