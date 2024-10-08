@extends('administrator::layouts.master')

@section('title', 'Daftar Kategori')

@push('style')
@endpush

@section('content')
    <x-common::utils.breadcrumb title="Kategori">
        <x-common::utils.breadcrumb-item href="{{ route('administrator.course.main.index') }}" page="Kelas" />
        <x-common::utils.breadcrumb-item page="Daftar Kategori" />
    </x-common::utils.breadcrumb>
    <livewire:administrator::course-category.table />
@endsection

@push('script')
@endpush
