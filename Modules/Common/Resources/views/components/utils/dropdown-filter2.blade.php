@php
    $filterId = randAlpha();
@endphp
<div x-data="{ {{ $filterId }}: false }" id="{{ $filterId }}"
     class="relative inline-flex items-center bg-red-500 text-white rounded-full pl-4 pr-2 py-2 text-xs">
    {{ $slot }}

    <button x-on:click="{{ $filterId }} = ! {{ $filterId }}"
            class="rounded-full bg-red-500 flex justify-center items-center ms-1">
        <i class="bx bx-chevron-down text-base"></i>
    </button>

    @isset($query)
        @if ($query)
            <a class="leading-none rounded-full bg-red-500 flex justify-center items-center ms-1"
               href="javascrirt:void(0)" wire:click="$set('{{ $property }}', '')">
                <i class="bx bx-x text-base"></i>
            </a>
        @endif
    @endisset

    <div x-show="{{ $filterId }}" x-bind:class="{{ $filterId }} ? 'open opacity-100' : 'hidden'"
         class="absolute left-0 top-[90%] opacity-0 w-40 z-50 mt-2 transition-all duration-300 bg-red-500 rounded-lg p-2">
        @isset($item)
            {{ $item }}
        @endisset
    </div>
</div>
