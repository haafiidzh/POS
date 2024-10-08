@extends('front::layouts.master')

@push('meta')
    <x-front::meta :title="cache('seo_judul_pembayaran_berhasil')" :description="cache('seo_description_pembayaran_berhasil')" :image="cache('seo_gambar_pembayaran_berhasil')" :keyword="cache('seo_keyword_pembayaran_berhasil')" />
@endpush

@push('style')
    {{--  --}}
@endpush

@section('content')
    <x-front::utils.breadcrumb-minimal title="Pembayaran" />

    <section class="relative bg-slate-100 py-16">
        <div class="container">
            <div class="card bg-white shadow w-full max-w-[700px] m-auto md:p-10">
                <div class="card-body text-center">
                    @if ($status == 'success')
                        <img class="w-full max-w-[300px] mx-auto my-8" src="{{ cache('image_payment_success') }}"
                             alt="">
                        <h3 class="mb-2 text-slate-700">Pembayaran Berhasil!</h3>
                        <p class="mb-8 text-slate-500 text-sm">
                            Pembayaran kamu telah diverifikasi dengan sukses, menandakan bahwa transaksi kamu telah berhasil
                            diselesaikan dengan aman dan lancar.
                        </p>
                    @elseif($status == 'failed')
                        <img class="w-full max-w-[300px] mx-auto my-8" src="{{ cache('image_payment_error') }}"
                             alt="">
                        <h3 class="mb-2 text-slate-700">Pembayaran Gagal!</h3>
                        <p class="mb-8 text-slate-500 text-sm">
                            Kami ingin memastikan bahwa setiap masalah pembayaran kamu diselesaikan secepat mungkin. Kami
                            menyarankan untuk memeriksa kembali informasi pembayaran kamu dan pastikan bahwa semua detail
                            yang diperlukan telah diisi dengan benar.
                        </p>
                    @endif
                    <a href="{{ route('customer.order') }}" class="btn primary text-sm">Pesanan Saya</a>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('script')
    {{--  --}}
@endpush
