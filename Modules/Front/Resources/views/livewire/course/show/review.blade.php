<section class="card" x-data="{
    expanded: false
}">
    <div class="flex items-center gap-2 mb-5">
        <div class="flex items-center gap-2">
            <h2 class="text-2xl">Comments</h2>
            <span class="text-sm bg-gray-200 px-2 py-1 rounded-md">{{ numberShortner($reviews->total()) }}</span>
        </div>

        <a class="ml-auto text-primary/75 hover:text-primary" href="javascript:void(0)" x-on:click="expanded = !expanded">
            <span class="text-sm" x-text="expanded ? 'Sembunyikan' : 'Lihat semua'"></span>
        </a>
    </div>

    <div class="">
        <x-front::utils.dropdown class="btn light text-sm px-6 rounded-[2rem] shadow-none hover:shadow-none"
                                 :lists="$sort_order" placeholder="Terbaru" property="sort" />

        <div class="overflow-hidden pb-8 mb-5 relative" wire:loading.class="skeleton" wire:target="sort,loadMore"
             x-bind:class="expanded ? '' : 'max-h-[190px]'" x-transition.enter.duration.500ms
             x-transition.leave.duration.300ms>

            @foreach ($reviews as $review)
                <div class="card {{ !$loop->last ? 'border-b' : '' }}">
                    <div class="card-body">
                        <div class="flex gap-3">
                            <div class="w-auto">
                                <div class="h-10 w-10 relative overflow-hidden rounded-full">
                                    <img src="{{ optional($review->customer)->getAvatar() }}"
                                         class="avatar h-full w-full object-cover object-center" alt="">
                                </div>
                            </div>
                            <div class="w-auto">
                                <h6 class="text-sm mb-1">
                                    {{ optional($review->customer)->name ?: 'Deleted User' }}</h6>
                                <div class="inline-flex items-center text-sm text-gray-500">
                                    <i class="bx bxs-star mr-1 text-yellow-400"></i>{{ $review->rating }}
                                    <div class="mx-1">&bullet;</div>
                                    <p>{{ diffForHuman($review->created_at) }}</p>
                                </div>
                                <p class="text-sm/relaxed tracking-wider text-gray-600 mt-2">
                                    {{ $review->message }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="absolute h-12 left-0 bottom-0 right-0 bg-gradient-to-t from-white" x-show="!expanded"></div>
        </div>

        <div class="relative" x-show="expanded" style="display: none">
            <div class="text-center mb-10">
                <x-front::utils.button class="btn primary text-sm" :loading="true" target="loadMore"
                                       wire:click="loadMore">
                    Lebih Bayak
                </x-front::utils.button>
            </div>
        </div>
    </div>
</section>
