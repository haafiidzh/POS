@extends('administrator::layouts.master')

@section('title', 'Halaman Web')

@push('style')
@endpush

@section('content')
    <div id="main-wrapper">
        <x-common::utils.breadcrumb title="Halaman Web">
            <li class="breadcrumb-item active" aria-current="page">Halaman Web</li>

            <x-slot name="button">
                <a href="{{ route('administrator.page.create') }}" class="btn bg-primary">
                    + Page </a>
            </x-slot>
        </x-common::utils.breadcrumb>
        <div class="row">
            <div class="col-12">
                <livewire:administrator::page.table />
            </div>
        </div>
    </div>
@endsection

@push('script')
@endpush
