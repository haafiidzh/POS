<section class="pb-16 pt-24">
    <div class="container">
        <div>
            <div class="grid grid-cols-2 mb-10">
                <div class="col-span-1">
                    <span class="text-sm font-medium py-1 px-3 rounded-full text-primary bg-primary/10">
                        {{ cache('homepage.course_popular.title') }}
                    </span>
                    <p class="text-gray-500 mt-3">{{ cache('homepage.course_popular.description') }}</p>
                </div>
                <div class="col-span-1 text-end self-end">
                    <a href="{{ route('front.course.index', ['sort' => 'oldest']) }}" class="text-primary">
                        Selengkapnya <i class="bx bx-right-arrow-alt ml-2"></i>
                    </a>
                </div>
            </div>

            @if (!$datas->isEmpty())
                <div class="scrollbar horizontal overflow-x-scroll py-6">
                    <div class="flex gap-x-3">
                        @foreach ($datas as $course)
                            <div class="flex-1 w-full sm:w-4/12 min-w-[300px] sm:min-w-[300px]">
                                <x-front::utils.card-course :course="$course" />
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>
