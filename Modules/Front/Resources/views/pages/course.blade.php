@extends('front::layouts.master')

@push('meta')
    <x-front::meta :title="cache('seo_judul_kelas')" :description="cache('seo_description_kelas')" :image="cache('seo_gambar_kelas')" :keyword="cache('seo_keyword_kelas')" />
@endpush

@push('style')
@endpush

@section('content')
    <x-front::utils.breadcrumb-minimal :title="cache('breadcrumb.course.title')" :description="cache('breadcrumb.course.description')" />
    <section class="w-screen overflow-x-hidden">
        <livewire:front::course.listing />
    </section>
@endsection
