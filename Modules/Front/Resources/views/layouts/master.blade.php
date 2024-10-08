<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @stack('meta')

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ cache('favicon') }}">

    <link href="{{ asset('assets/front/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/front/libs/aos/aos.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ mix('assets/front/css/front.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ mix('assets/front/css/icons.css') }}" rel="stylesheet" type="text/css">
    <script src="https://cdn.tailwindcss.com"></script>

    @livewireStyles

    @stack('style')
</head>

<body class="text-gray-700">
    <livewire:front::layouts.navbar />
    {{-- <livewire:front::layouts.pos /> --}}


    @yield('content')

    {{-- <x-front::footer /> --}}

    <button data-toggle="back-to-top"
        class="fixed text-sm rounded-full z-10 bottom-5 end-5 h-9 w-9 text-center bg-primary/20 text-primary flex justify-center items-center">
        <i class="bx bx-chevron-up text-base"></i>
    </button>

    @livewireScripts
    <script src="{{ asset('assets/front/libs/@frostui/tailwindcss/frostui.js') }}"></script>
    <script src="{{ asset('assets/front/libs/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/front/libs/aos/aos.js') }}"></script>
    <script src="{{ mix('assets/front/js/front.js') }}"></script>

    @stack('script')

    <script type="text/javascript">
        (function() {
            document.MODE = '{{ env('APP_ENV') }}';
        })()
    </script>
</body>

</html>
