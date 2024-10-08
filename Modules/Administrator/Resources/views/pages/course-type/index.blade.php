@extends('administrator::layouts.master')

@section('title', 'Daftar Jenis Kelas')

@push('style')
@endpush

@section('content')
    <x-common::utils.breadcrumb title="Jenis Kelas">
        <x-common::utils.breadcrumb-item href="{{ route('administrator.course.main.index') }}" page="Kelas" />
        <x-common::utils.breadcrumb-item page="Daftar Jenis Kelas" />
    </x-common::utils.breadcrumb>
    <livewire:administrator::course-type.table />
@endsection

@push('script')
@endpush
