<footer class="bg-slate-900 overflow-hidden">
    @if (!request()->routeIs('customer.*'))
        <section class="relative bg-gray-900">
            <div
                 class="w-full h-full rounded-full bg-gradient-to-r from-[#58AEF1] to-pink-500 absolute -top-12 -right-14 blur-2xl opacity-10">
            </div>
            <div class="py-12 ">
                <div class="container">
                    <div class="grid lg:grid-cols-2 items-center gap-6">
                        <div class="flex">
                            <div class="h-full px-4 text-white self-center">
                                <i class="bx bx-md bx-phone"></i>
                            </div>

                            <div>
                                <h1 class="text-white text-2xl font-medium mb-2">Butuh seminar offline?</h1>
                                <p class="text-slate-400">Jadwalkan sekarang untuk langkah awal yang berharga!</p>
                            </div>
                        </div>
                        <div class="text-end">
                            <a href="{{ cache('') }}" class="btn primary block sm:!w-fit sm:ml-auto">
                                Jadwalkan Seminar
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
    

    <div class="border-b border-slate-600"></div>

    <div class="container {{ request()->routeIs('customer.*') ? 'pt-12' : 'pt-12' }}">
        <div class="grid lg:grid-cols-2 grid-cols-1 gap-14 py-6">
            <div>
                <a href="{{ route('front.index') }}">
                    <img src="{{ cache('footer_logo') }}" class="h-20 mb-3">
                </a>
                <p class="text-slate-400/80 mt-5 w-4/5">{{ cache('footer_description') }}</p>
            </div>

            

            <div>
                <div class="flex flex-col sm:flex-row gap-8 sm:gap-14 flex-wrap sm:flex-nowrap justify-between">
                    
                    @if (cache('visitor_count'))
                    <div class="mb-4 text-sm">
                        <div class="!mb-2 my-1 text-white">Pengunjung</div>
                        <hr class="my-2 border-slate-600">

                        <div class="text-slate-400/80 flex flex-col gap-2">
                            @isset(cache('visitor_count')['visitor_today'])
                                <div class="flex gap-2">
                                    <span class="capitalize">Hari ini:</span>
                                    <p>{{ number(cache('visitor_count')['visitor_today'], 0) }}</p>
                                </div>
                            @endisset
                            @isset(cache('visitor_count')['visitor_weekly'])
                                <div class="flex gap-2">
                                    <span class="capitalize">Minggu ini:</span>
                                    <p>{{ number(cache('visitor_count')['visitor_weekly'], 0) }}</p>
                                </div>
                            @endisset
                            @isset(cache('visitor_count')['visitor_monthly'])
                                <div class="flex gap-2">
                                    <span class="capitalize">Bulan ini:</span>
                                    <p>{{ number(cache('visitor_count')['visitor_monthly'], 0) }}</p>
                                </div>
                            @endisset
                            @isset(cache('visitor_count')['visitor_yearly'])
                                <div class="flex gap-2">
                                    <span class="capitalize">Tahun ini:</span>
                                    <p>{{ number(cache('visitor_count')['visitor_yearly'], 0) }}</p>
                                </div>
                            @endisset
                        </div>
                    </div>
                @endif

                    <div>
                        <div class="flex flex-col gap-2">
                            <h5 class="text-xs uppercase text-white">Useful Links</h5>
                            <hr class="my-1 border-slate-600">
                            <div class="text-slate-400/80">
                                <a href="{{ route('front.blog.index') }}">Blog</a>
                            </div>
                            <div class="text-slate-400/80">
                                <a href="{{ route('front.faq') }}">FAQ</a>
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="flex flex-col gap-3">
                            <h5 class="text-xs uppercase text-white">Company</h5>
                            <hr class="my-1 border-slate-600">
                            <div class="text-slate-400/80">
                                <a href="{{ route('front.about') }}">Tentang Kami</a>
                            </div>
                            <div class="text-slate-400/80">
                                <a href="{{ route('front.contact') }}">Hubungi Kami</a>
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="flex flex-col gap-3">
                            <h5 class="text-xs uppercase text-white">Others</h5>
                            <hr class="my-1 border-slate-600">
                            {{-- <div class="text-slate-400/80">
                                <a href="{{ route('front.payment-method') }}">Metode Pembayaran</a>
                            </div> --}}
                            <div class="text-slate-400/80">
                                <a href="{{ route('front.terms-conditions') }}">Syarat & Ketentuan</a>
                            </div>
                            <div class="text-slate-400/80">
                                <a href="{{ route('front.privacy-policy') }}">Kebijakan Privasi</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="border-b border-slate-600 my-4"></div>

        <div class="flex justify-center gap-6 pt-5 pb-10">
            <p class="text-slate-400/80 text-sm">{{ cache('copyright') }}</p>
        </div>
    </div>

</footer>
