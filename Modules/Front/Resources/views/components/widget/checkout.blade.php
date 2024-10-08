@if (!$hasCourse)
    <div class="card mt-20 border border-slate-200 hidden lg:block lg:mb-24">
        <div class="card-body text-slate-500">
            <div class="grid grid-cols-8 gap-2 mb-3">
                <div class="col-span-3">
                    <img class="rounded" src="{{ $course->getThumbnail() }}" alt="Gambar {{ $course->name }}">
                </div>
                <div class="col-span-5">
                    <div class="flex items-center text-sm text-gray-500 mb-2">
                        <i class="bx bxs-star mr-1 text-yellow-400"></i> {{ $course->total_ratings }}
                        @if ($course->category)
                            <div class="mx-1">•</div>
                            <p>{{ $course->category->name }}</p>
                        @endif
                    </div>

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
                </div>
            </div>

            <div class="text-sm py-1">
                @if ($course->discount_price)
                    <small class="text-danger/50">
                        <del>{{ price($course->price, true) }}</del>
                    </small>
                @endif
                <span class="text-slate-600 font-semibold"> {{ $course->getPrice() }}</span>
            </div>

            <h2 class="text-slate-800 text-base mb-2">{{ $course->name }}</h2>

            <p class="text-sm mb-5">{{ $course->short_description }}</p>


            <div class="grid grid-cols-8 gap-2">
                {{-- <a href="javascript:void(0)" class="btn outline-light col-span-1" wire:click="addToWishlist">
                    <i class="bx bx-heart scale-150"></i>
                </a> --}}
                @auth('customer')
                    <a href="javascript:void(0)"
                       class="btn outline-light col-span-2 !py-1 self-center h-full flex items-center justify-center"
                       wire:click="addToCart('{{ $course->id }}')">
                        <i class="bx bx-cart-add"></i>
                    </a>
                    <x-front::utils.button class="btn primary col-span-6" :loading="true"
                                           target="processToCheckoutFromCourse('{{ $course->id }}')"
                                           wire:click="processToCheckoutFromCourse('{{ $course->id }}')">
                        Beli Kelas
                    </x-front::utils.button>
                @else
                    <a href="{{ route('customer.login.form', ['next' => request()->url()]) }}"
                       class="btn outline-light col-span-2 !py-1 self-center h-full flex items-center justify-center"
                       wire:click="addToCart('{{ $course->id }}')">
                        <i class="bx bx-cart-add"></i>
                    </a>
                    <a href="{{ route('customer.login.form', ['next' => request()->url()]) }}"
                       class="btn primary col-span-6 !py-1 md:!py-3">
                        <div class="grid grid-cols-5 gap-2">
                            <span class="col-span-5 text-center">Beli Sekarang</span>
                        </div>
                    </a>
                @endauth
            </div>
        </div>
    </div>
@else
@endif
