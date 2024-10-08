@extends('administrator::layouts.master')

@section('title', 'Artikel')

@push('style')
    {{--  --}}
@endpush

@section('content')
    <x-common::utils.breadcrumb title="Artikel">
        <x-common::utils.breadcrumb-item page="Artikel" />

        @slot('action')
            @can('create.article', 'web')
                <a href="{{ route('administrator.post.article.create') }}" class="btn bg-primary text-white rounded-full">
                    <i class="bx bx-plus me-2"></i> Tambah
                </a>
            @endcan
        @endslot
    </x-common::utils.breadcrumb>

    <livewire:administrator::post.table />
@endsection

@push('script')
    {{--  --}}
@endpush
