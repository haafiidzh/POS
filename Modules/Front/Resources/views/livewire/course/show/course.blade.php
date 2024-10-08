<div>
    <section class="pt-20">

        <div class="mb-4 rounded-lg overflow-hidden aspect-[16/9] w-full">
            <div id="player" data-plyr-provider="youtube" data-plyr-embed-id="{{ $course->video_id }}"></div>
        </div>

        <h1 class="lg:text-4xl text-3xl">
            {{ $course->name }}
        </h1>

        <div class="mb-8">
            <div class="flex flex-wrap items-center justify-between gap-2 md:gap-6">
                <div class="flex items-center gap-3 mt-7">
                    <ul class="flex flex-wrap gap-1">
                        <li class="px-2 py-1 bg-slate-200 text-slate-500 text-xs rounded">
                            <i class="bx bx-time mr-1"></i> {{ $course->getDuration(true) }}
                        </li>
                        <li class="px-2 py-1 bg-slate-200 text-slate-500 text-xs rounded">
                            <i class="bx bx-book-open mr-1"></i> {{ $course->total_lessons }} Materi
                        </li>
                        <li class="px-2 py-1 bg-slate-200 text-slate-500 text-xs rounded">
                            <i class="bx bx-cart-alt mr-1"></i> Terjual {{ numberShortner($course->total_orders) }}
                        </li>
                    </ul>
                </div>
                <div class="flex gap-2 items-center">
                    <p class="text-sm text-gray-500">SHARE:</p>
                    <div class="shareon" data-url="{{ route('front.course.show-course', ['course' => $course->slug]) }}"
                         data-title="{{ $course->name }}" data-text="{{ $course->short_description }}"
                         data-media="{{ $course->getThumbnail() }}">
                        <a class="scale-75 md:scale-100 whatsapp"></a>
                        <a class="scale-75 md:scale-100 facebook"></a>
                        <a class="scale-75 md:scale-100 twitter"></a>
                        <a class="scale-75 md:scale-100 linkedin"></a>
                        <a class="scale-75 md:scale-100 copy-url"></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <h2 class="text-2xl mb-3 mt-10">About</h2>
        <p class="mb-6 prose max-w-screen-lg">{!! $course->description !!}</p>
    </section>

    @if ($course->key_points)
        <section>
            <h2 class="text-2xl mb-3 mt-10">Key Points</h2>
            <div class="grid lg:grid-cols-2 grid-cols-1 gap-4">
                @foreach (json_decode($course->key_points) as $item)
                    <div class="relative bg-slate-100 rounded-lg px-2 py-3 flex items-center gap-x-2">
                        <div>
                            <div class="w-10 h-10 grid place-items-center rounded-full">
                                <i class="bx bx-check text-green-500 text-2xl"></i>
                            </div>
                        </div>
                        <p class="text-sm">{{ $item }}</p>
                    </div>
                @endforeach
            </div>
        </section>
    @endif
</div>

@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const player = new Plyr('#player', {
                tooltips: {
                    controls: true,
                    seek: true
                },
                youtube: {
                    noCookie: false,
                    controls: 0,
                    rel: 0,
                    showinfo: 0,
                    iv_load_policy: 3,
                    modestbranding: 1
                },
                embed: {
                    seekTo: 180
                }
            });
        })
    </script>
@endpush
