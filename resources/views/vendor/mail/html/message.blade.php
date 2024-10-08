<x-mail::layout>
{{-- Header --}}
<x-slot:header>
<x-mail::header :url="config('app.url')">
@php
    $logo = substr(cache('logo'), 0, 1) == '/' ? substr(cache('logo'), 1) : cache('logo');
    $base64 = 'data:image/jpg;base64,' . base64_encode(file_get_contents($logo));
@endphp
<img src="{{ $base64 }}" style="height: 100px" alt="Logo {{ cache('app_name') }}">
</x-mail::header>
</x-slot:header>

{{-- Body --}}
{{ $slot }}

{{-- Subcopy --}}
@isset($subcopy)
<x-slot:subcopy>
<x-mail::subcopy>
{{ $subcopy }}
</x-mail::subcopy>
</x-slot:subcopy>
@endisset

{{-- Footer --}}
<x-slot:footer>
<x-mail::footer>
{{ cache('copyright') }}
</x-mail::footer>
</x-slot:footer>
</x-mail::layout>
