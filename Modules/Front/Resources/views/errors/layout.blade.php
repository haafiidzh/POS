<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @stack('meta')

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ cache('favicon') }}">
    <link href="{{ mix('assets/front/css/front.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ mix('assets/front/css/icons.css') }}" rel="stylesheet" type="text/css">

    @livewireStyles
    @stack('style')
</head>

<body class="text-gray-700">
    <livewire:front::layouts.navbar />

    <section class="pb-24 relative bg-gradient-to-t from-slate-50 to-white">
        <div class="container">
            <div class="mx-auto max-w-screen-xl">
                <div class="mx-auto max-w-screen-sm text-center pb-16">
                    @yield('image')

                    <h1 class="mb-4 text-3xl tracking-tight font-extrabold lg:text-5xl text-primary">
                        @yield('error_code')
                    </h1>
                    <p class="mb-4 text-lg font-light text-slate-500">
                        @yield('error_message')
                    </p>
                    <a href="{{ url('/') }}" class="btn primary inline-flex items-center gap-1">
                        <i class="bx bx-left-arrow-alt"></i> Kembali ke halaman utama
                    </a>
                </div>
            </div>

        </div>
    </section>

    <x-front::footer />

    <button data-toggle="back-to-top"
            class="fixed text-sm rounded-full z-10 bottom-5 end-5 h-9 w-9 text-center bg-primary/20 text-primary flex justify-center items-center">
        <i class="bx bx-chevron-up text-base"></i>
    </button>

    @livewireScripts
    <script src="{{ asset('assets/front/libs/@frostui/tailwindcss/frostui.js') }}"></script>
    <script src="{{ mix('assets/front/js/front.js') }}"></script>

    @stack('script')

    <script type="text/javascript">
        (function() {
            document.MODE = '{{ env('APP_ENV') }}';
        })()
    </script>
</body>

</html>
