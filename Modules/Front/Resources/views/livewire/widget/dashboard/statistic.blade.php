<section class="relative">
    <div class="container">
        <div class="flex">
            <div class="w-full">
                <h3 class="text-xl text-gray-800 mt-2">Hi, {{ $customer->name }}!</h3>
                <p class="mt-1 font-medium mb-4">Selamat datang di Dashboard {{ cache('app_name') }}!</p>
            </div>
        </div>
        <div class="grid grid-cols-12 gap-6 mt-2">
            <div class="lg:col-span-5 col-span-12">
                <div class="bg-white rounded">
                    <div class="p-6">
                        <div class="flex border-b pb-5 mb-5">
                            <div class="grow">
                                <div class="flex">
                                    <div class="w-12 h-12 rounded-full mr-3 overflow-hidden">
                                        <img src="{{ $customer->getAvatar() }}"
                                             class="object-cover object-center w-full h-full" alt="Avatar">
                                    </div>
                                    <div class="grow">
                                        <h4 class="tetx-lg text-gray-800 mb-1 mt-1 font-semibold">
                                            {{ $customer->name }}
                                        </h4>
                                        <p class="text-gray-400 pb-0 text-xs mb-2">{{ $customer->email }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="shrink text-end">
                                <a class="btn bg-slate-200 !text-slate-700 hover:bg-slate-300 !font-normal px-3 py-2 transition"
                                   href="{{ route('customer.profile') }}">
                                    <i class="bx bx-edit"></i>
                                </a>
                            </div>
                        </div>

                        <div class="flex items-center gap-6 mt-4">
                            <div class="w-full">
                                <div class="flex justify-between mb-3">
                                    <h6 class="fw-medium my-0">Kelas Diselesaikan</h6>
                                    <p class="float-end mb-0">{{ $course_progress['percentage'] }}</p>
                                </div>
                                <div
                                     class="flex w-full h-1.5 bg-gray-200 rounded-full overflow-hidden dark:bg-gray-700 ">
                                    <div class="flex flex-col justify-center overflow-hidden bg-primary"
                                         role="progressbar" style="width: {{ $course_progress['percentage'] }}"
                                         aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-3 col-span-12 space-y-6">
                <div class="bg-white">
                    <div class="flex items-center px-3 py-4">
                        <div class="">
                            <div class="inline-flex items-center justify-center h-12 w-12 bg-sky-500/10 rounded mr-3">
                                <i class="bx bx-book-open text-sky-500 text-xl"></i>
                            </div>
                        </div>
                        <div class="grow">
                            <h3 class="text-xl text-gray-800">{{ $course_progress['total_courses'] }}</h3>
                            <p class="text-muted mb-0 text-sm">Total Kelas</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white">
                    <div class="flex items-center px-3 py-4">
                        <div class="">
                            <div class="inline-flex items-center justify-center h-12 w-12 bg-green-500/10 rounded mr-3">
                                <i class="bx bx-check-circle text-green-500 text-xl"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <h3 class="text-xl text-gray-800">{{ $course_progress['total_complete_courses'] }}</h3>
                            <p class="text-muted mb-0 text-sm">Kelas Diselesaikan</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-4 col-span-12">
                <div class="bg-white">
                    <div class="p-6">
                        <h4 class="text-base font-semibold text-gray-800 mb-2">Latest Lessons</h4>
                        @forelse ($latest_lessons as $progress)
                            <div class="py-2 {{ $loop->last ?: 'border-b' }}">
                                <a href="{{ route('front.course.show-lesson', [
                                    'course' => $progress->course->slug,
                                    'lesson' => $progress->lesson->slug,
                                ]) }}"
                                   class="text-slate-600 hover:text-slate-800 mb-2 mt-0 font-semibold">
                                    {{ $progress->lesson->name }}
                                </a>
                                <p class="text-slate-400 text-xs">
                                    {{ diffForHumans($progress->updated_at) }}
                                </p>
                            </div>
                        @empty
                            <div class="py-2">
                                <p class="text-slate-400 text-sm">
                                    Upsss... Sepertinya kamu belum memutar materi dari kelas yang kamu punya.
                                </p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
