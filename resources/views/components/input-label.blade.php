@props(['value'])

<label {{ $attributes->merge(['class' => 'registerText block font-medium text-sm text-gray-700']) }}>
    {{ $value ?? $slot }}
</label>
