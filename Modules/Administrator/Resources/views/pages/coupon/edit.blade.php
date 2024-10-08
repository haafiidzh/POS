@extends('administrator::layouts.master')

@section('title', 'Edit Coupon')

@push('style')
@endpush

@section('content')
    <div id="main-wrapper">
        <x-common::utils.breadcrumb title="Coupon">
            <li class="breadcrumb-item active" aria-current="page">
                <a href="{{ route('administrator.setting.coupon.index') }}">Coupon</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Edit</li>

            <x-slot name="button">
                <a href="{{ route('administrator.setting.coupon.index') }}" class="btn bg-primary">
                    <i class="bx bx-left-arrow-alt mt-1 mr-1"></i> Kembali
                </a>
            </x-slot>
        </x-common::utils.breadcrumb>
        <div class="row">
            <div class="col-12">
                <livewire:administrator::coupon.edit :coupon="$coupon" />
            </div>
        </div>
    </div>
@endsection

@push('script')
@endpush
