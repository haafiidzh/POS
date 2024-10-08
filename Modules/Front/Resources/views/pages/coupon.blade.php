@extends('front::layouts.master')

@push('meta')
    <x-front::meta :title="cache('seo_judul_kupon')" :description="cache('seo_description_kupon')" :image="cache('seo_gambar_kupon')" :keyword="cache('seo_keyword_kupon')" />
@endpush

@push('style')
    {{--  --}}
@endpush

@section('content')
    <x-front::utils.breadcrumb-minimal :title="cache('breadcrumb.coupon.title')" :description="cache('breadcrumb.coupon.description')" />

    <section class="relative bg-slate-100 py-16">
        <div class="container">
            <livewire:front::coupon.listing />
        </div>
    </section>
@endsection

@push('script')
    {{--  --}}
@endpush
