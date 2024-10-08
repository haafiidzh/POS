<section class="relative bg-slate-100 py-16">
    <div class="container">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
            <div class="col-span-1 lg:col-span-8 xl:col-span-6">
                <div class="mb-6">
                    <h2 class="mb-2">{{ cache('verify_certificate.title') }}</h2>
                    <p class="text-slate-600 font-normal">
                        {{ cache('verify_certificate.description') }}
                    </p>
                </div>

                <form wire:submit.prevent="applyFilter">
                    <div class="flex">
                        <div class="input-group append">
                            <input type="text" name="search" class="form-input"
                                   placeholder="Masukkan kode sertifikat..." wire:model.defer="search">

                            <x-front::utils.button class="text !bg-primary/80 hover:!bg-primary !text-white"
                                                   :loading="true" target="applyFilter">
                                <i class="bx bxearch mr-1"></i>Cari
                            </x-front::utils.button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-span-1 lg:col-span-8">
                @if (optional($certificate)->customer)
                    <div class="card bg-slate-600 border-2 border-white rounded-xl">
                        <div class="card-body">
                            <div class="flex gap-x-4">
                                <div class="relative">
                                    <div
                                         class="w-12 md:w-16 h-1w-12 md:h-16 rounded-full overflow-hidden border border-white">
                                        <img class="w-full h-full object-cover object-center"
                                             src="{{ $certificate->customer->getAvatar() }}" alt="">
                                    </div>
                                    <span
                                          class="h-4 w-4 md:h-6 md:w-6 bg-green-700 text-white absolute -top-1 right-0 rounded-full flex items-center justify-center">
                                        <i class="bx bx-check text-sm md:text-base"></i>
                                    </span>
                                </div>
                                <div class="text-white">
                                    <h3 class="text-xl mb-2">
                                        Diselesaikan oleh, {{ $certificate->customer->name }}.
                                    </h3>
                                    <p class="text-slate-300 text-sm">
                                        <b>{{ $certificate->customer->name }}</b> terverifikasi telah menyelesaikan
                                        kelas
                                        pada platform {{ cache('app_name') }} dengan judul
                                        <b>"{{ $certificate->course->name }}"</b> pada
                                        tanggal <b>{{ dateTimeTranslated($certificate->completed_at, 'd M Y') }}</b>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="my-6">

                    <h2 class="mb-4">Informasi Kelas</h2>
                    <div class="grid grid-cols-1">
                        <div class="col-span-1 flex flex-col sm:flex-row w-full">
                            <div class="flex mb-3 sm:me-2">
                                <div>
                                    <div class="aspect-[4/3] border border-light rounded overflow-hidden w-28">
                                        <img class="w-full h-full object-cover object-center"
                                             src="{{ $certificate->course->getThumbnail() }}" alt="product-image" />
                                    </div>
                                </div>
                            </div>
                            <div class="sm:ms-2 w-full">
                                <div class="grid grid-cols-6">
                                    <div class="col-span-4">
                                        <p
                                           class="text-base/snug font-normal  mb-2 whitespace-nowrap text-ellipsis overflow-hidden">
                                            <a href="{{ route('front.course.show-course', $certificate->course->slug) }}"
                                               class="text-slate-700 hover:text-black">{{ $certificate->course->name }}</a>
                                        </p>
                                    </div>
                                    <div class="col-span-2 text-end">

                                    </div>
                                </div>
                                <div class="grid grid-cols-6">
                                    <div class="col-span-4">
                                        <ul class="flex gap-x-2 gap-y-1 flex-wrap text-[10px] mb-2">
                                            <li class="px-2 py-1 bg-slate-200 text-slate-500 rounded">
                                                <i class="bx bx-time mr-1"></i>
                                                {{ $certificate->course->getDuration(true) }}
                                            </li>
                                            <li class="px-2 py-1 bg-slate-200 text-slate-500 rounded">
                                                <i class="bx bx-book-open mr-1"></i>
                                                {{ $certificate->course->total_lessons }} Materi
                                            </li>
                                            <li class="px-2 py-1 bg-slate-200 text-slate-500 rounded">
                                                <i class="bx bx-cart-alt mr-1"></i> Terjual
                                                {{ numberShortner($certificate->course->total_orders) }}
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-span-2 text-end">
                                        @auth('customer')
                                            <x-front::utils.button class="btn primary text-sm" :loading="true"
                                                                   target="processToCheckoutFromCourse('{{ $certificate->course->id }}')"
                                                                   wire:click="processToCheckoutFromCourse('{{ $certificate->course->id }}')">
                                                Beli Kelas
                                            </x-front::utils.button>
                                        @else
                                            <a href="{{ route('customer.login.form', ['next' => route('front.accomplishment.verify', $search)]) }}"
                                               class="btn primary text-sm">
                                                Beli Kelas
                                            </a>
                                        @endauth
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="my-6">

                    @if ($certificate->course->key_points)
                        <h2 class="mb-4">Apa yang kamu pelajari</h2>
                        <div class="grid lg:grid-cols-2 grid-cols-1 gap-4">
                            @foreach (json_decode($certificate->course->key_points) as $item)
                                <div class="relative bg-slate-200 rounded-xl px-3 py-4 flex items-center gap-x-2">
                                    <div>
                                        <div class="w-10 h-10 grid place-items-center rounded-full">
                                            <i class="bx bx-check text-green-500 text-2xl"></i>
                                        </div>
                                    </div>
                                    <p class="text-sm">{{ $item }}</p>
                                </div>
                            @endforeach
                        </div>
                    @endif
                @else
                    <x-front::utils.404 class="border border-gray-200 !bg-transparent">
                        Upsss... Sepertinya kami tidak menemukan sertifikat yang kamu Cari...
                    </x-front::utils.404>
                @endif
            </div>
        </div>
    </div>
</section>
