@if (!$hasCourse)
    <div class="fixed bottom-0 z-50 w-full -translate-x-1/2 bg-white shadow-[rgba(0,0,15,0.15)_0px_-6px_20px_0px] left-1/2 lg:hidden rounded-t-[1.5rem]"
         x-data="{ expanded: false }">
        <div class="card">
            <div class="card-body !p-2">
                <button class="flex items-center justify-center w-full font-semibold text-left transition"
                        x-on:click="expanded = !expanded">
                    <span class="material-symbols-rounded text-xl block transition-all">
                        <i class="bx bx-chevron-up text-lg transition-all transition-transform"
                           x-bind:class="expanded ? 'rotate-180' : ''"></i>
                    </span>
                </button>

                <div class="text-base mb-2 px-2">
                    <h2 class="text-slate-600">{{ $course->name }}</h2>
                    <div class="flex items-center text-sm text-gray-500 mb-2">
                        <i class="bx bxs-star mr-1 text-yellow-400"></i> {{ $course->total_ratings }}
                        @if ($course->category)
                            <div class="mx-1">•</div>
                            <p>{{ $course->category->name }}</p>
                        @endif
                    </div>
                </div>

                <div class="px-2" x-show="expanded" x-collapse style="display: none">

                    <ul class="flex flex-wrap gap-x-2 gap-y-1 text-xs mb-2">
                        <li class="px-2 py-1 bg-slate-200 text-slate-500 rounded">
                            <i class="bx bx-time mr-1"></i> {{ $course->getDuration(true) }}
                        </li>
                        <li class="px-2 py-1 bg-slate-200 text-slate-500 rounded">
                            <i class="bx bx-book-open mr-1"></i> {{ $course->total_lessons }} Materi
                        </li>
                        <li class="px-2 py-1 bg-slate-200 text-slate-500 rounded">
                            <i class="bx bx-cart-alt mr-1"></i> Terjual
                            {{ numberShortner($course->total_orders) }}
                        </li>
                    </ul>
                    <p class="text-sm mb-2">{{ $course->short_description }}</p>
                </div>

                <hr class="my-2">

                <div class="grid grid-cols-8 gap-2">
                    {{-- <a href="javascript:void(0)" class="btn outline-light col-span-1 !py-1 self-center h-full"
                       wire:click="addToWishlist">
                        <i class="bx bx-heart scale-150 mt-2"></i>
                    </a> --}}
                    @auth('customer')
                        <a href="javascript:void(0)"
                           class="btn outline-light col-span-2 !py-1 self-center h-full flex items-center justify-center"
                           wire:click="addToCart('{{ $course->id }}')">
                            <i class="bx bx-cart-add"></i>
                        </a>
                        <x-front::utils.button class="btn primary block col-span-6 !py-1 md:!py-3s"
                                               wire.loading.class="skeleton"
                                               target="processToCheckoutFromCourse('{{ $course->id }}')"
                                               wire:click="processToCheckoutFromCourse('{{ $course->id }}')">
                            <div class="grid grid-cols-6 gap-2">
                                <span class="col-span-3 flex items-center">Beli Sekarang</span>

                                <div class="col-span-3 flex">
                                    <div class="text-sm py-1 flex flex-col items-end w-full justify-center">
                                        <span class="text-white font-semibold"> {{ $course->getPrice() }}</span>
                                        @if ($course->discount_price)
                                            <small class="text-white/50">
                                                <del>{{ price($course->price, true) }}</del>
                                            </small>
                                        @endif
                                    </div>
                                    <div class="self-center" wire:loading
                                         wire:target="processToCheckoutFromCourse('{{ $course->id }}')">
                                        <div class="animate-spin inline-block ml-1 w-3 h-3 border-[2px] border-current border-t-transparent rounded-full"
                                             role="status" aria-label="loading">
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </x-front::utils.button>
                    @else
                        <a href="{{ route('customer.login.form', ['next' => request()->url()]) }}"
                           class="btn outline-light col-span-2 !py-1 self-center h-full flex items-center justify-center"
                           wire:click="addToCart('{{ $course->id }}')">
                            <i class="bx bx-cart-add"></i>
                        </a>
                        <a href="{{ route('customer.login.form', ['next' => request()->url()]) }}"
                           class="btn primary col-span-6 !py-1 md:!py-3">
                            <div class="grid grid-cols-6 gap-2">
                                <span class="col-span-3 flex items-center">Beli Sekarang</span>

                                <div class="col-span-3 flex">
                                    <div class="text-sm py-1 flex flex-col items-end w-full justify-center">
                                        <span class="text-white font-semibold"> {{ $course->getPrice() }}</span>
                                        @if ($course->discount_price)
                                            <small class="text-white/50">
                                                <del>{{ price($course->price, true) }}</del>
                                            </small>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
@else
@endif
