<div>
    @php
        $href = isset($href) ? $href : 'javascript:(0)';
    @endphp
    <a class="flex items-center py-4 px-4 text-sm rounded  bg-red-500 text-white rounded-full"
       href="{{ $href }}" {{ $attributes }}>
        {{ $slot }}
    </a>
</div>
