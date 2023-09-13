@props(['value'])

<label {{ $attributes->merge(['class' => 'text-gray-400 absolute -top-3 left-3 z-10 text-center']) }}>
    {{ $value ?? $slot }}
</label>
