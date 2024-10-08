@extends('front::layouts.master')

@push('meta')
    <x-front::meta :title="cache('seo_judul_blog')" :description="cache('seo_description_blog')" :image="cache('seo_gambar_blog')" :keyword="cache('seo_keyword_blog')" />
@endpush

@push('style')
@endpush

@section('content')
    <x-front::utils.breadcrumb-minimal :title="cache('breadcrumb.blog.title')" :description="cache('breadcrumb.blog.description')" />

    <section class="pb-24">
        <livewire:front::blog.listing />
    </section>
@endsection
