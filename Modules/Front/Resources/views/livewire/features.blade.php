<section class="py-20 bg-slate-900 relative">
    <div class="container">
        <div class="grid grid-cols-1 gap-y-8 lg:grid-cols-2 lg:items-center lg:gap-x-16">
            <div class="mx-auto max-w-lg lg:mx-0 ltr:lg:text-left rtl:lg:text-right">
                <h2 class="text-3xl font-bold sm:text-4xl text-slate-50">
                    {{ cache('homepage.why.title') }}
                </h2>

                <p class="mt-8 text-slate-400">
                    {{ cache('homepage.why.description') }}
                </p>
            </div>

            <div class="grid grid-cols-2 gap-4">
                @foreach ($features as $item)
                    <div class="block rounded-xl border-2 border-slate-700 p-4">
                        <span
                              class="inline-block rounded-lg bg-slate-700/50 h-12 w-12 text-2xl grid place-items-center text-slate-100">
                            <i class="bx {{ $item['icon'] }}"></i>
                        </span>

                        <h2 class="mt-2 font-bold text-slate-50">{{ $item['title'] }}</h2>

                        <p class="sm:mt-1 sm:text-sm text-slate-400">
                            {{ $item['description'] }}
                        </p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
