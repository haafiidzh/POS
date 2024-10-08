@extends('administrator::layouts.master')

@section('title', 'Daftar Visitor')

@push('style')
    {{--  --}}
@endpush

@section('content')
    <x-common::utils.breadcrumb title="Visitor">
        <x-common::utils.breadcrumb-item href="{{ route('administrator.visitor.index') }}" page="Visitor" />
        <x-common::utils.breadcrumb-item page="Daftar Visitor Website" />

        {{-- @slot('action')
            @can('create.slider', 'web')
                <a href="{{ route('administrator.slider.create') }}" class="btn bg-primary text-white rounded-full">
                    <i class="bx bx-plus me-2"></i> Tambah
                </a>
            @endcan
        @endslot --}}
    </x-common::utils.breadcrumb>
    <livewire:administrator::visitor.table />
@endsection

@push('script')
    {{--  --}}
@endpush
