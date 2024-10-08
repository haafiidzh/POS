@extends('administrator::layouts.master')

@section('title', 'Partner')

@push('style')
    {{--  --}}
@endpush

@section('content')
    <x-common::utils.breadcrumb title="Partner">
        <x-common::utils.breadcrumb-item page="Partner" />

        @slot('action')
            {{-- @can('create.partner', 'web') --}}
                <a href="{{ route('administrator.partner.create') }}" class="btn bg-primary text-white rounded-full">
                    <i class="bx bx-plus me-2"></i> Tambah
                </a>
            {{-- @endcan --}}
        @endslot
    </x-common::utils.breadcrumb>
    <livewire:administrator::partner.table />
@endsection

@push('script')
    {{--  --}}
@endpush
