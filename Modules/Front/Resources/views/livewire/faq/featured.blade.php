<section class="py-16 sm:py-24 bg-gradient-to-b from-slate-50">
    <div class="container">
        <div class="text-center">
            <span
                  class="text-sm font-medium py-1 px-3 rounded-full text-primary bg-primary/10">{{ cache('homepage.faq.small_title') }}</span>
            <h1 class="text-3xl/tight font-medium mt-3 mb-4">{{ cache('homepage.faq.title') }}</h1>
            <p class="text-slate-500 max-w-2xl m-auto">
                {{ cache('homepage.faq.description') }}
            </p>
        </div>

        <div data-fc-type="accordion" class="mt-14 lg:w-3/4 lg:mx-auto 2xl:w-2/3">
            @foreach ($datas as $data)
                <div class="border border-slate-300 rounded-lg mt-4">
                    <button class="p-5 inline-flex items-center justify-between w-full font-semibold text-left transition fc-collapse"
                            data-fc-type="collapse">
                        {{ $data->question }}
                        <span class="material-symbols-rounded text-xl block transition-all fc-collapse-open:rotate-180">
                            <i class="bx bx-chevron-up text-lg"></i>
                        </span>
                    </button>
                    <div class="w-full overflow-hidden transition-[height] duration-300 hidden" style="">
                        <p class="text-slate-600 font-light text-sm/6 pt-3 p-5">{{ $data->answer }}</p>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="text-center mt-14">
            <p class="inline-flex flex-wrap gap-1 bg-slate-100 text-sm rounded-lg py-2 px-5">
                Masih belum terjawab?
                <a href="{{ route('front.contact') }}" class="text-primary transition-all">
                    Hubungi Kami
                </a>
            </p>
        </div>
    </div>
</section>
