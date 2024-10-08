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
                    <article class="prose result leading-snug max-w-screen-lg"></article>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('script')
    <script src="{{ asset('assets/front/js/vendor/markdown-parser.js') }}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const result = document.querySelector('.result');
            const content = document.querySelector('#page-description');
            result.innerHTML = marked.parse(@json($page->description));

            const replacement = {
                app_name: '{{ cache('app_name') }}',
                app_url: `<a href="{{ url('/') }}">{{ url('/') }}</a>`,
                updated_at: '{{ dateTimeTranslated($page->updated_at) }}',
                phone: '<a href="{{ phone(cache('contact_phone'), 'id', 'RFC3966') }}">{{ phone(cache('contact_phone'), 'ID', 'INTERNATIONAL') }}</a>',
                address: '{{ cache('contact_address') }}',
                email: `<a href="mailto:{{ cache('contact_email') }}">{{ cache('contact_email') }}</a>`,
                support_email: `<a href="mailto:{{ cache('contact_support_email') }}">{{ cache('contact_support_email') }}</a>`,
                contact_link: `<a href="{{ route('front.contact') }}">{{ route('front.contact') }}</a>`,
            }

            const replaceText = (key, value) => {
                return result.innerHTML = result.innerHTML.replaceAll('{' + key + '}', value);
            }

            Object.keys(replacement).map((key) => {
                replaceText(key, replacement[key])
            });

        })
    </script>
@endpush
