@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-weight-light text-small text-secondary ']) }} class="font-weight-light">
    {{ $value ?? $slot }}
</label>
