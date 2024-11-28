@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-[#8e4b71]']) }}>
    {{ $value ?? $slot }}
</label>
