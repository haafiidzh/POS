<div class="p-3 bg-white border border-gray-200 rounded">
    <h3>Terpopuler</h3>
    <hr class="my-3">
    <div class="grid grid-cols-1 gap-2">
        @foreach ($populars as $popular)
            <div class="{{ !$loop->last ? 'border-b' : '' }} px-2 pt-2 pb-4">
                <div class="flex flex-wrap gap-1">
                    <span class="bg-orange-500/10 text-orange-500 font-medium rounded-md text-[10px] py-1 px-2">
                        <a href="{{ route('front.blog.index', ['category' => optional($popular->category)->slug]) }}">
                            {{ optional($popular->category)->name }}
                        </a>
                    </span>
                    <span class="bg-gray-500/10 text-gray-500 font-medium rounded-md text-[10px] py-1 px-2">
                        <i class="bx bx-time"></i> {{ $popular->reading_time }}
                    </span>
                </div>
                <h5 class="mt-2 text-sm font-bold leading-4 text-slate-800 line-clamp-2 text-ellipsis">
                    <a href="{{ route('front.blog.show', $popular->slug_title) }}">
                        {{ $popular->title }}
                    </a>
                </h5>
            </div>
        @endforeach
    </div>
</div>
