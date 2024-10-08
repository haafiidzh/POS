@extends('administrator::layouts.master')

@section('title', 'Daftar Transaction')

@push('style')
@endpush

@section('content')
    <div id="main-wrapper">
        <x-common::utils.breadcrumb title="Transaction">
            <li class="breadcrumb-item active" aria-current="page">Daftar Transaction</li>

            <x-slot name="button">
                <a href="{{ route('administrator.transaction.create') }}" class="btn bg-primary">
                    + Transaction
                </a>
            </x-slot>
        </x-common::utils.breadcrumb>
        <div class="row">
            <div class="col-12">
                <livewire:administrator::transaction.table />
            </div>
        </div>
    </div>
@endsection

@push('script')
@endpush
