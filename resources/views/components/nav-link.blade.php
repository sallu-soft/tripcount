@props(['active'])

@php
$classes = ($active ?? false)
            ? 'flex items-center w-full h-12 px-3 rounded text-sm text-white font-light bg-[#00959E] no-underline'
            : 'flex items-center w-full h-12 font-light px-3 text-sm rounded hover:text-white hover:bg-[#00959E] no-underline';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
