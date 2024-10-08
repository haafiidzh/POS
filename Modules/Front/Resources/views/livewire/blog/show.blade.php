<div class="grid lg:grid-cols-12 grid-cols-1 gap-10 items-center py-20" id="scrollTarget">
    <div class="lg:col-span-8">
        <img class="w-full mb-5 rounded" src="{{ $post->getThumbnail() }}" alt="{{ $post->title }}">
        <div class="lg:w-4/5">
            <span class="bg-orange-500/10 text-orange-500 font-medium rounded-md text-xs py-1 px-2">
                <a href="{{ route('front.blog.index', ['category' => optional($post->category)->slug]) }}">
                    {{ optional($post->category)->name }}
                </a>
            </span>
            <h1 class="lg:text-5xl text-3xl mt-3">
                {{ $post->title }}
            </h1>
        </div>

        <div class="mb-8">
            <div class="flex flex-wrap items-center justify-between gap-6">

                <div class="flex items-center gap-3 mt-7">
                    <div class="h-11 w-11 rounded-full overflow-hidden">
                        <img src="{{ optional($post->writer)->getAvatar() }}" alt="avatar"
                             class="w-full h-full object-cover object-center">
                    </div>

                    <div>
                        <h6 class="text-sm transition-all hover:text-primary">
                            <a>{{ optional($post->writer)->name }}</a>
                        </h6>
                        <p class="text-sm text-gray-500">
                            {{ dateTimeTranslated($post->created_at) }} · {{ $post->reading_time }}
                        </p>
                    </div>
                </div>

                <div class="flex gap-2">
                    <p class="text-sm text-gray-500">SHARE:</p>
                    <div class="flex gap-3">

                        <span>
                            <a href="#">
                                <svg class="w-5 h-5 text-blue-500" xmlns="http://www.w3.org/2000/svg"
                                     viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                     stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z">
                                    </path>
                                </svg>
                            </a>
                        </span>

                        <span>
                            <a href="#">
                                <svg class="w-5 h-5 text-teal-500" xmlns="http://www.w3.org/2000/svg"
                                     viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                     stroke-linecap="round" stroke-linejoin="round">
                                    <path
                                          d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z">
                                    </path>
                                </svg>
                            </a>
                        </span>

                        <span>
                            <a href="#">
                                <svg class="w-5 h-5 text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round">
                                    <rect x="2" y="2" width="20" height="20" rx="5" ry="5">
                                    </rect>
                                    <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                    <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                                </svg>
                            </a>
                        </span>

                    </div>
                </div>

            </div>
        </div>

        {!! $post->description !!}

        <div>
            <div class="flex flex-wrap sm:gap-2 gap-5 mt-10">
                @foreach ($post->getTags() as $tag)
                    <div>
                        <a href="{{ route('front.blog.index', ['tag' => $tag]) }}"
                           class="text-xs bg-gray-200 rounded-md font-medium transition-all hover:shadow-md hover:bg-gray-300/80 focus:bg-gray-300/80 py-2 px-4">
                            {{ $tag }}
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="lg:col-span-4 self-start lg:sticky lg:top-36">
        <livewire:front::blog.widget.popular />
    </div>
</div>
