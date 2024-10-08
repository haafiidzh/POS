@extends('administrator::layouts.master')

@section('title', 'Daftar Pesanan')

@push('style')
    <style>
        .order-status {
            border-radius: 5px;
            cursor: pointer;
        }

        .order-status:hover{
            background-color: #5d45a4;
            color: white;
            font-weight: bold;
        }

        .order-status.active {
            background-color: #8B6AF1;
            color: white;
        }

        .item-icon {
            margin-right: 5px;
            font-size: 17px;
            vertical-align: middle;
            line-height: 22px;
            /* color: white */
        }

        .show-order:hover {
            color: #5d45a4;
            font-weight: bold;
        }

        .marker{
            font-size: 0.75rem;
            font-weight: bold;
        }
    </style>
@endpush

@section('content')
    <x-common::utils.breadcrumb title="Daftar Pesanan">
        <x-common::utils.breadcrumb-item href="{{ route('administrator.order.index') }}" page="Pesanan" />
        <x-common::utils.breadcrumb-item page="Daftar Pesanan" />

        {{-- @slot('action')
            <a href="{{ route('administrator.order.create') }}" class="btn bg-primary text-white rounded-full">
                <i class="bx bx-plus me-2"></i> Tambah
            </a>
        @endslot --}}
    </x-common::utils.breadcrumb>
    <livewire:administrator::order.table />
@endsection

@push('script')
    {{--  --}}
@endpush
