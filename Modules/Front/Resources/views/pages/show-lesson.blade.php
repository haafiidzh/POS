@extends('front::layouts.master')

@push('meta')
    <x-front::meta :title="$course->name" :description="$course->short_description" :image="$course->getThumbnail()" />
@endpush

@push('style')
    <link rel="stylesheet" href="{{ asset('assets/front/libs/plyr/plyr.css') }}">
@endpush

@section('content')
    <x-front::utils.breadcrumb-minimal :title="cache('breadcrumb.course.title')" :pages="[
        ['link' => route('front.course.index'), 'title' => 'Kelas'],
        ['link' => route('front.course.show-course', ['course' => $course->slug]), 'title' => $course->name],
        [
            'link' => route('front.course.show-lesson', [
                'course' => $course->slug,
                'lesson' => $lesson->slug,
            ]),
            'title' => $lesson->name,
        ],
    ]" breadcrumb />
    <div class="container">
        <livewire:front::course.show-lesson :course="$course" :lesson="$lesson" />
    </div>
@endsection

@push('script')
    <script src="{{ asset('assets/front/libs/plyr/plyr.min.js') }}"></script>
@endpush
