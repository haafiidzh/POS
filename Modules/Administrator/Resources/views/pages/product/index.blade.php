@extends('administrator::layouts.master')

@section('title', 'Produk')

@push('style')
    {{--  --}}
@endpush

@section('content')
    <x-common::utils.breadcrumb title="Produk">
        <x-common::utils.breadcrumb-item page="Produk" />

        @slot('action')
            {{-- @can('create.product', 'web') --}}
                <a href="{{ route('administrator.product.create') }}" class="btn bg-primary text-white rounded-full">
                    <i class="bx bx-plus me-2"></i> Tambah
                </a>
            {{-- @endcan --}}
        @endslot
    </x-common::utils.breadcrumb>

    <livewire:administrator::product.table />
@endsection

@push('script')
    {{--  --}}
@endpush
