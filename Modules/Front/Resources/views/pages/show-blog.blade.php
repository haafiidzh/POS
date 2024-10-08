@extends('front::layouts.master')

@push('meta')
    <x-front::meta :title="$post->title" :description="$post->subject" :image="$post->getThumbnail()" :keyword="$post->tags" />
@endpush

@push('style')
@endpush

@section('content')
    <x-front::utils.breadcrumb-minimal :title="cache('breadcrumb.blog.title')" :pages="[
        ['link' => route('front.blog.index'), 'title' => 'Blog'],
        ['link' => route('front.blog.show', $post->slug_title), 'title' => $post->title],
    ]" breadcrumb />

    <div class="container">
        <livewire:front::blog.show :post="$post" />
    </div>
@endsection
