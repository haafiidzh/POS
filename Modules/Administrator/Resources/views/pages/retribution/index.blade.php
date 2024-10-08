@extends('administrator::layouts.master')

@section('title', 'Retribusi')

@push('style')
    {{--  --}}
@endpush

@section('content')
    <x-common::utils.breadcrumb title="Retribusi">
        <x-common::utils.breadcrumb-item page="Retribusi" />

        @slot('action')
            {{-- @can('create.retribution', 'web') --}}
                <a href="{{ route('administrator.retribution.create') }}" class="btn bg-primary text-white rounded-full">
                    <i class="bx bx-plus me-2"></i> Tambah
                </a>
            {{-- @endcan --}}
        @endslot
    </x-common::utils.breadcrumb>

    <livewire:administrator::retribution.table />
@endsection

@push('script')
    {{--  --}}
@endpush
