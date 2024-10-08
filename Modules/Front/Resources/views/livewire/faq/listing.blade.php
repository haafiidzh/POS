<section class="relative bg-slate-100 py-16 z-10">
    <div class="container mx-auto">
        <div class="w-full p-4">
            <div class="mx-auto text-center mb-10 lg:max-w-screen-md">
                <h2 class="text-dark my-4 text-3xl font-bold sm:text-3xl">{{ cache('faq.title') }}</h2>
                <p class="text-base text-body-color mb-6">{{ cache('faq.description') }}</p>
                <form wire:submit.prevent="applyFilter">
                    <div class="flex">
                        <div class="input-group append w-full">
                            <input type="text" name="search" class="form-input text-base !py-3 px-4"
                                   placeholder="Cari pertanyaan disini..." wire:model.defer="search">

                            <x-front::utils.button class="text !bg-white hover:!bg-white" :loading="true"
                                                   target="applyFilter">
                                <i class="bx bxearch"></i>
                            </x-front::utils.button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- <div class="my-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4">
                <div>
                    <div class="flex flex-col gap-2">
                        <h5 class="text-lg font-semibold mb-3">General</h5>
                        <div class="text-slate-500 text-sm">
                            <a href="{{ route('front.course.index') }}">Kelas</a>
                        </div>
                        <div class="text-slate-500 text-sm">
                            <a href="{{ route('front.accomplishment.verify') }}">Cek Sertifikat</a>
                        </div>
                        <div class="text-slate-500 text-sm">
                            <a href="{{ route('front.coupon') }}">Kupon</a>
                        </div>
                        <div class="text-slate-500 text-sm">
                            <a href="{{ route('front.blog.index') }}">Blog</a>
                        </div>
                        <div class="text-slate-500 text-sm">
                            <a href="{{ route('front.faq') }}">FAQ</a>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 w-full p-4">
            @forelse ($datas as $faq)
                <div class="col-span-1" x-data="{ expanded: false }">
                    <div class="border border-slate-200 bg-white rounded-lg mt-4">
                        <button class="p-5 inline-flex items-center justify-between w-full font-semibold text-left transition"
                                x-on:click="expanded = !expanded">
                            {{ $faq->question }}

                            <span class="material-symbols-rounded text-xl block transition-all">
                                <i class="bx bx-chevron-down text-lg transition-all transition-transform"
                                   x-bind:class="expanded ? 'rotate-180' : ''"></i>
                            </span>
                        </button>

                        <div class="w-full duration-300" x-show="expanded" x-collapse style="display: none">
                            <p class="text-slate-600 font-light text-sm/6 pt-3 p-5">
                                {{ $faq->answer }}
                            </p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-2">
                    <x-front::utils.404 class="ring-2 ring-gray-200">
                        Upsss... Kita tidak menemukan pertanyaan atau jawaban yang kamu cari.
                        Coba gunakan keyword lainnya ya...
                    </x-front::utils.404>
                </div>
            @endforelse
        </div>
        {{ $datas->onEachSide(0)->links('livewire::front-tailwind') }}
    </div>
</section>
