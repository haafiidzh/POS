@extends('administrator::layouts.master')

@section('title', 'Daftar Histori Retribusi')

@push('style')
@endpush

@section('content')
    <x-common::utils.breadcrumb title="Histori Retribusi">
        <x-common::utils.breadcrumb-item href="{{ route('administrator.post.article.index') }}" page="Artikel" />
        <x-common::utils.breadcrumb-item page="Daftar Histori Retribusi" />
    </x-common::utils.breadcrumb>
    <livewire:administrator::history-retribution.table />
@endsection

@push('script')
@endpush
