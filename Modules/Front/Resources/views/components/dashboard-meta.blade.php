@php
    $page_title = isset($title) ? ($title ?: cache('seo_judul_beranda')) : cache('seo_judul_beranda');
    $page_description = isset($description)
        ? ($description ?:
        cache('seo_deskripsi_beranda'))
        : cache('seo_deskripsi_beranda');
@endphp

<!-- Primary Meta Tags -->
<title>{{ $page_title }} - {{ config('app.name', 'Laravel') }}</title>
<meta name="title" content="{{ $page_title }}" />
<meta name="description" content="{{ $page_description }}" />
