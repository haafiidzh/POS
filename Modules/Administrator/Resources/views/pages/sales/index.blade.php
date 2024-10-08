@extends('administrator::layouts.master')

@section('title', 'Transaksi')

@push('style')
@endpush

@section('content')
    <div id="main-wrapper">
        <x-common::utils.breadcrumb title="Transaksi">
            <li class="breadcrumb-item active" aria-current="page">Daftar Transaksi</li>
        </x-common::utils.breadcrumb>
        
        <div class="row">
            <div class="col-12">
                <livewire:administrator::sales.overview/>
            </div>
        </div>
    </div>
@endsection

@push('script')
@endpush
