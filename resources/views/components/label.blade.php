@props(['value','for'])

<label for="{{ $for }}" {{ $attributes->merge(['class' => 'block font-medium text-sm text-primary mb-2 mt-3']) }}>
    {{ $value ?? $slot }}
</label>