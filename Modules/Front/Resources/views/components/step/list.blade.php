<li class="relative">
    <button type="button"
            class="w-full px-4 py-3 lg:px-8 ;g:py-6 text-left bg-slate-100 lg:text-xl font-semibold rounded"
            x-on:click="selected !== {{ $loop->iteration }} ? selected = {{ $loop->iteration }} : selected = null">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div>
                    <span class="h-10 w-10 grid place-items-center bg-slate-200 rounded-full">
                        {{ $loop->iteration }}
                    </span>
                </div>
                <span>{{ $step->name }}</span>
            </div>
            <div class="w-12">
                <span class="h-6 w-6 bg-slate-200 rounded-full grid place-items-center ml-auto">
                    <i class="bx bx-chevron-down transition-all duration-300"
                       x-bind:class="selected == {{ $loop->iteration }} ? 'rotate-180' : ''"></i>
                </span>
            </div>
        </div>
    </button>

    <div class="px-4 lg:px-8 relative overflow-hidden transition-all max-h-0 duration-300" style=""
         x-ref="step_{{ $loop->iteration }}"
         x-bind:style="selected == {{ $loop->iteration }} ? 'max-height: ' + $refs
             .step_{{ $loop->iteration }}
             .scrollHeight + 'px' : ''">
        <div>
            @foreach ($step->childs as $index => $lesson)
                <x-front::lesson.list :course="$course" :progress="$progress" :step="$step" :lesson="$lesson" />
            @endforeach
        </div>
    </div>
</li>
