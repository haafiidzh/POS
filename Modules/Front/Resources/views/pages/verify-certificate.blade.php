@extends('front::layouts.master')

@push('meta')
    <x-front::meta :title="cache('seo_judul_verifikasi_sertifikat')" :description="cache('seo_deskripsi_verifikasi_sertifikat')" :image="cache('seo_gambar_verifikasi_sertifikat')" :keyword="cache('seo_keyword_verifikasi_sertifikat')" />
@endpush

@push('style')
    {{--  --}}
@endpush

@section('content')
    <x-front::utils.breadcrumb-minimal :title="cache('breadcrumb.verify_certificate.title')" :description="cache('breadcrumb.verify_certificate.description')" />
    <livewire:front::certificate.verify :certificate_id="request('certificate')" />
@endsection

@push('script')
    {{--  --}}
@endpush
