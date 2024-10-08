@extends('administrator::layouts.master')

@section('title', 'Tambah Kupon')

@push('style')
@endpush

@section('content')
    <div id="main-wrapper">
        <x-common::utils.breadcrumb title="Kupon">
            <li class="breadcrumb-item active" aria-current="page">
                <a href="{{ route('administrator.setting.coupon.index') }}">Kupon</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Tambah</li>

            <x-slot name="button">
                <a href="{{ route('administrator.setting.coupon.index') }}" class="btn bg-primary">
                    <i class="bx bx-left-arrow-alt mt-1 mr-1"></i> Kembali
                </a>
            </x-slot>
        </x-common::utils.breadcrumb>
        <div class="row">
            <div class="col-12">
                <livewire:administrator::coupon.create />
            </div>
        </div>
    </div>
@endsection

@push('script')
@endpush
