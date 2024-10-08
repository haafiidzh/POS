@extends('administrator::layouts.master')

@section('title', 'Daftar Kategori')

@push('style')
@endpush

@section('content')
    <x-common::utils.breadcrumb title="Kategori">
        <x-common::utils.breadcrumb-item href="{{ route('administrator.product.category.index') }}" page="Produk" />
        <x-common::utils.breadcrumb-item page="Daftar Kategori Produk" />
    </x-common::utils.breadcrumb>
    <livewire:administrator::product-category.table />
@endsection

@push('script')
@endpush
