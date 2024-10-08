<section class="relative overflow-hidden">
    <div class="container">
        <div class="flex items-center justify-between my-6">
            <div class="">
                <h4 class="text-base text-gray-800">Your Courses</h4>
            </div>
            <div class="text-end">
                <a href="{{ route('customer.course') }}" class="font-semibold text-primary text-sm flex items-center">
                    View All
                    <i class="bx bx-right-arrow-alt text-xl"></i>
                </a>
            </div>
        </div>

        <div class="grid lg:grid-cols-3 sm:grid-cols-2 grid-cols-1 gap-6 my-3">

            @forelse ($courses as $item)
                @php
                    $lesson_progress_count = $item->lesson_progress_count;
                    $lessons_count = $item->lessons_count;
                    $progress = round(($lesson_progress_count / $lessons_count) * 100, 2) . '%';
                @endphp

                <div class="bg-white rounded">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="grow">
                                <p class="text-gray-400 text-sm font-medium">
                                    {{ dateTimeTranslated($item->created_at) }}
                                </p>
                            </div>
                            <div class="shrink text-end">
                                <x-front::utils.alpine-dropdown>
                                    <i class="bx bx-dots-horizontal text-xl"></i>

                                    <x-slot name="list">
                                        <a href="{{ route('front.course.show-course', [
                                            'course' => $item->course_slug,
                                        ]) }}"
                                           class="flex
                                           items-center gap-2 w-full first-of-type:rounded-t-md
                                           last-of-type:rounded-b-md px-4 py-2.5 text-left text-sm hover:bg-gray-50
                                           disabled:text-gray-500">
                                            Lihat Kelas
                                        </a>

                                        @if ($item->is_complete)
                                            <a href="{{ route('front.accomplishment.certificate', [
                                                'certificate_id' => $item->certificate_id,
                                            ]) }}"
                                               class="flex items-center gap-2 w-full first-of-type:rounded-t-md last-of-type:rounded-b-md px-4 py-2.5 text-left text-sm hover:bg-gray-50 disabled:text-gray-500"
                                               target="_blank">
                                                Sertifikat
                                            </a>
                                        @endif
                                    </x-slot>
                                </x-front::utils.alpine-dropdown>

                            </div>
                        </div>


                        <div class="mt-3">
                            <div class="flex flex-wrap gap-1">
                                <span
                                      class="inline-flex items-center gap-1.5 py-1 px-2 rounded-md text-xs bg-slate-200 text-slate-700 font-semibold mb-2">
                                    {{ $item->category_name }}
                                </span>
                                <span
                                      class="inline-flex items-center gap-1.5 py-1 px-2 rounded-md text-xs bg-slate-200 text-slate-700 font-semibold mb-2">
                                    <i
                                       class="bx bx-book-bookmark"></i>{{ $lesson_progress_count . '/' . $lessons_count }}
                                </span>
                            </div>
                            <h4 class="mt-0 mb-1">
                                <a class="text-lg text-gray-600 hover:text-primary"
                                   href="{{ route('front.course.show-course', [
                                       'course' => $item->course_slug,
                                   ]) }}">
                                    {{ $item->course_name }}
                                </a>
                            </h4>
                        </div>


                        <div class="mt-4">
                            <div class="flex mb-3">
                                <div class="grow">
                                    <h6 class="mt-0">Progress</h6>
                                </div>
                                <div class="shrink text-end">
                                    <small class="fw-semibold">{{ $progress }}</small>
                                </div>
                            </div>
                            <div class="flex w-full h-1.5 bg-gray-200 rounded-full overflow-hidden dark:bg-gray-700 ">
                                <div class="flex flex-col justify-center overflow-hidden bg-green-500"
                                     role="progressbar" style="width: {{ $progress }}" aria-valuenow="25"
                                     aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-3 sm:col-span-2 lg:col-span-3">
                    <x-front::utils.404 class="border">
                        Upsss... Sepertinya kamu belum memiliki kelas saat ini.
                    </x-front::utils.404>
                </div>
            @endforelse
        </div>
    </div>
</section>
