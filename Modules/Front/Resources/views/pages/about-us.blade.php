@extends('front::layouts.master')

@push('meta')
    <x-front::meta :title="cache('seo_judul_tentang_kami')" :description="cache('seo_description_tentang_kami')" :image="cache('seo_gambar_tentang_kami')" :keyword="cache('seo_keyword_tentang_kami')" />
@endpush

@push('style')
@endpush

@section('content')
    <header class="h-full w-screen place-items-center bg-white px-8 py-28">
        <div class="container mx-auto grid items-center lg:grid-cols-2">
            <div class="text-center lg:text-left">
                <div class="mb-8 inline-flex items-center rounded-lg border border-dark/30 py-1 pl-1 pr-3">
                    <p
                       class="block antialiased font-sans text-sm leading-normal mr-3 rounded-md bg-dark py-0.5 px-3 font-medium text-white">
                        SOC Media Academy
                    </p>
                    <p
                       class="block antialiased font-sans text-sm font-light text-dark leading-normal text-inherit !flex !items-center !font-semibold">
                        New Moves, New Chances
                        <i class="bx bx-right-arrow-alt ml-2"></i>
                    </p>
                </div>
                <h1
                    class="block antialiased tracking-normal font-sans text-5xl font-semibold text-blue-gray-900 mb-8 leading-tight lg:text-6xl text-dark">
                    Lewati perubahan karir dengan percaya diri.
                </h1>
                <p class="block antialiased font-sans text-xl font-normal leading-relaxed lg:pr-20 text-blue-gray-800">
                    Jembatan bagi para fresh graduates, profesional, dan pekerja yang ingin berkarir di dunia digital.
                </p>
            </div>
            <div class="hidden lg:flex">
                <img src="https://placehold.co/1080x1920/png" alt="iphone" class="max-w-md rounded-3xl ml-auto">
            </div>
        </div>
    </header>

    <section class="py-28 py-16">
        <div class="container">
            <div class="grid lg:grid-cols-3 grid-cols-1 gap-10">
                <div class="flex flex-col items-center lg:items-start">
                    <div class="border-t-2 border-gray-300 w-1/5 mb-7"></div>
                    <h1 class="text-3xl">About Us</h1>
                </div>

                <div class="lg:col-span-2 prose max-w-screen-xl">
                    <p class="mb-4 indent-8">
                        Dengan nama PT Mulia Media Bersama, SOC Media Group berpegang teguh pada nilai
                        "Mergi Milining Berkah", yang berarti mengalirkan keberkahan ke mana pun ia berada. Sejak berdiri,
                        kami telah
                        mengembangkan berbagai layanan yang mencakup digital marketing agency, visual branding, hingga
                        software house, semua dengan tujuan yang sama: memberikan dampak positif dan keberkahan di setiap
                        langkah yang kami ambil.
                    </p>
                    <p class="mb-4 indent-8">
                        SOC Media Academy adalah salah satu inisiatif utama dari SOC Media Group, dirancang khusus untuk
                        menjawab kebutuhan edukasi generasi muda yang ingin mengembangkan diri di era digital. Kami
                        menyediakan e-course yang dirancang untuk membantu fresh graduates, profesional, dan pekerja
                        yang
                        ingin beralih karir ke bidang digital.
                    </p>
                    <p class="mb-4 indent-8">
                        Dengan SOC Media Academy, Anda tidak hanya mendapatkan pengetahuan, tetapi juga pengalaman belajar
                        yang unik dengan fokus pada kualitas, fleksibilitas, dan pemberdayaan. Kami berkomitmen untuk
                        menjadi jembatan menuju masa depan yang lebih cerah dan sukses di dunia digital bagi setiap individu
                        yang bergabung dengan kami.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <livewire:front::features />

    <livewire:front::faq.featured />
@endsection
