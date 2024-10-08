@extends('front::layouts.master')

@push('meta')
    <x-front::meta :title="cache('seo_judul_checkout')" :description="cache('seo_description_checkout')" :image="cache('seo_gambar_checkout')" :keyword="cache('seo_keyword_checkout')" />
@endpush

@push('style')
    {{--  --}}
@endpush

@section('content')
    <x-front::utils.breadcrumb-minimal :title="cache('breadcrumb.checkout.title')" :description="cache('breadcrumb.checkout.description')" />

    <section class="relative bg-slate-100 py-16">
        <div class="container">
            @if ($customer = auth('customer')->user())
                <livewire:front::checkout :customer="$customer" :token="request('token')" />
            @else
                <div class="grid grid-cols-1 gap-6">
                    <div class="col-span-1">
                        <div class="mb-6 rounded bg-white px-6 py-14 border text-center mx-auto max-w-3xl">
                            <img class="w-[200px] m-auto mb-8" src="{{ cache('image_authentication') }}"
                                 alt="Authentication Needed">
                            <p class="font-normal w-[75%] max-w-[400px] m-auto mb-8">
                                Ooops! Sepertinya kamu sesi kamu telah habis, silahkan login terlebih dahulu.
                            </p>

                            <a href="{{ route('customer.login.form', ['next' => request()->path()]) }}"
                               class="btn primary px-8">Masuk Sekarang</a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection

@push('script')
    {{--  --}}
@endpush
