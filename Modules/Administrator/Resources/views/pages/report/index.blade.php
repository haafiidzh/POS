@extends('administrator::layouts.master')

@section('title', 'Laporan')

@push('style')
@endpush

@section('content')
    <x-common::utils.breadcrumb title="Laporan">
        <x-common::utils.breadcrumb-item href="javascript:void(0)" page="Laporan" />
    </x-common::utils.breadcrumb>

    <livewire:administrator::report.overview />
@endsection

@push('script')
    {{--  --}}
@endpush
