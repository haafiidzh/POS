@extends('front::layouts.master')

@push('meta')
    <x-front::meta :title="$page->title" :description="$page->short_description" :image="cache('seo_gambar_beranda')" :keyword="cache('seo_keyword_beranda')" />
@endpush

@push('style')
    {{--  --}}
@endpush

@section('content')
    <x-front::utils.breadcrumb-minimal :title="$page->title" :descrription="$page->short_description" />

    <section class="relative bg-slate-100 py-16">
        <div class="container">
            <div class="grid grid-cols-1 lg:grid-cols-12">
                <div class="col-span-1 lg:col-span-8" id="page-content">
                    {!! $page->description !!}
                </div>
            </div>
        </div>
    </section>
@endsection

@push('script')
    <script>
        (function() {
            // const CONTENT = document.querySelector('#page-content').textContent;
            // const TEMPLATE = "{query}";
            // const names = TEMPLATE.search(/[^\{\}]+(?=\})/g);
            // const regex = TEMPLATE.replace(/{.+?}/g, "(.*)");
            // const values = CONTENT.match(new RegExp(regex)).slice(1);
            // const result = Object.fromEntries(names.map((s, i) => [s, values[i]]))
            // console.log(CONTENT)
        })()
    </script>
@endpush
