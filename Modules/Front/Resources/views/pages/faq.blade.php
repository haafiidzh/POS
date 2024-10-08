@extends('front::layouts.master')

@push('meta')
    <x-front::meta :title="cache('seo_judul_faq')" :description="cache('seo_description_faq')" :image="cache('seo_gambar_faq')" :keyword="cache('seo_keyword_faq')" />
@endpush

@push('style')
@endpush

@section('content')
    <x-front::utils.breadcrumb-minimal :title="cache('breadcrumb.faq.title')" :description="cache('breadcrumb.faq.description')" />
    <livewire:front::faq.listing />
@endsection
