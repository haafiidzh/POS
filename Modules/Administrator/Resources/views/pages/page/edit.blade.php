@extends('administrator::layouts.master')

@section('title', 'Edit Halaman Web')

@push('style')
    {{-- Summernote --}}
    <link href="{{ asset('vendor/summernote/css/summernote-lite.min.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div id="main-wrapper">
        <x-common::utils.breadcrumb title="Halaman Web">
            <li class="breadcrumb-item active" aria-current="page">
                <a href="{{ route('administrator.page.index') }}">Halaman Web</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Edit</li>

            <x-slot name="button">
                <a href="{{ route('administrator.page.index') }}" class="btn bg-primary">
                    <i class="bx bx-left-arrow-alt mt-1 mr-1"></i> Kembali
                </a>
            </x-slot>
        </x-common::utils.breadcrumb>
        <div class="row">
            <div class="col-md-8">
                <livewire:administrator::page.edit :page="$page" />
            </div>
        </div>
    </div>
@endsection

@push('script')
    {{-- Summernote --}}
    <script src="{{ asset('vendor/summernote/js/summernote-lite.min.js') }}"></script>
@endpush
