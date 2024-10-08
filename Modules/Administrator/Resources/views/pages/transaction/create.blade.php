@extends('administrator::layouts.master')

@section('title', 'Tambah Transaction')

@push('style')
@endpush

@section('content')
    <div id="main-wrapper">
        <x-common::utils.breadcrumb title="Transaction">
            <li class="breadcrumb-item active" aria-current="page">
                <a href="{{ route('administrator.transaction.index') }}">Transaction</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Tambah</li>

            <x-slot name="button">
                <a href="{{ route('administrator.transaction.index') }}" class="btn bg-primary">
                    <i class="bx bx-left-arrow-alt mt-1 mr-1"></i> Kembali
                </a>
            </x-slot>
        </x-common::utils.breadcrumb>
        <div class="row">
            <div class="col-12">
                <livewire:administrator::transaction.create />
            </div>
        </div>
    </div>
@endsection

@push('script')
@endpush
