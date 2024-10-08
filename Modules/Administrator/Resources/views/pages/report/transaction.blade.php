@extends('administrator::layouts.master')

@section('title', 'Transaksi')

@push('style')
@endpush

@section('content')
    <x-common::utils.breadcrumb title="Transaksi">
        <x-common::utils.breadcrumb-item href="javascript:void(0)" page="Laporan" />
        <x-common::utils.breadcrumb-item page="Transaksi" />
    </x-common::utils.breadcrumb>

    <livewire:administrator::report.transaction />
@endsection

@push('script')
    {{--  --}}
@endpush
