@if ($step->canAccessLesson($progress, $step, $lesson))
    <a href="{{ route('front.course.show-lesson', ['course' => $course->slug, 'lesson' => $lesson->slug]) }}">
        <div class="p-3 flex justify-between">
            <div class="flex items-center gap-3 text-sm">
                <div>
                    <span class="h-6 w-6 bg-primary text-white rounded-full grid place-items-center">
                        <i class="bx bx-play text-xl translate-x-[1px]"></i>
                    </span>
                </div>
                {{ $lesson->name }}
            </div>
            <div class="w-14 text-end">
                <span class="px-2 py-1 bg-slate-200 text-slate-500 text-xs rounded-lg">
                    {{ $lesson->getDuration() }}
                </span>
            </div>
        </div>
    </a>
@else
    <a>
        <div class="p-3 flex justify-between">
            <div class="flex items-center gap-3 text-sm">
                <div>
                    <span class="h-6 w-6 bg-dark text-white rounded-full grid place-items-center">
                        <i class="bx bx-lock-alt"></i>
                    </span>
                </div>
                {{ $lesson->name }}
            </div>
            <div class="w-14 text-end">
                <span class="px-2 py-1 bg-slate-200 text-slate-500 text-xs rounded-lg">
                    {{ $lesson->getDuration() }}
                </span>
            </div>
        </div>
    </a>
@endif
