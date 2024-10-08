@extends('administrator::layouts.master')

@section('title', 'Daftar Kupon')

@push('style')
@endpush

@section('content')
    <x-common::utils.breadcrumb title="Kupon">
        <x-common::utils.breadcrumb-item page="Daftar Kupon" />
    </x-common::utils.breadcrumb>
    <livewire:administrator::coupon.table />
@endsection

@push('script')
@endpush
