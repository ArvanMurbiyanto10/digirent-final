@props(['value'])

{{--
    PERUBAHAN DI SINI:
    'text-indigo-800' diubah menjadi 'text-gray-900'
    agar labelnya hitam dan sangat jelas terlihat.
--}}
<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-gray-900']) }}>
    {{ $value ?? $slot }}
</label>
