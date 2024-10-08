@extends('front::layouts.master')

@push('meta')
    <x-front::meta :title="cache('seo_judul_beranda')" :description="cache('seo_description_beranda')" :image="cache('seo_gambar_beranda')" :keyword="cache('seo_keyword_beranda')" />
@endpush

@push('style')
@endpush

@section('content')
    <!-- Content -->
    
    <livewire:front::pos.pos />


@endsection
