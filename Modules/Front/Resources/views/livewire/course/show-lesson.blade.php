<section class="py-20">
    <div class="grid lg:grid-cols-12 grid-cols-1 gap-10 items-center" id="scrollTarget">
        <div class="lg:col-span-8">
            <div wire:ignore>
                <div class="mb-4 rounded-lg overflow-hidden aspect-[16/9] w-full">
                    <div id="player" data-plyr-provider="youtube" data-plyr-embed-id="{{ $lesson->video_id }}">
                    </div>
                </div>
                <p class="lg:text-lg mb-2 text-slate-500 hover:text-slate-800 font-normal flex items-center">
                    <i class="bx bx-book mr-1"></i>
                    <a href="{{ route('front.course.show-course', ['course' => $course->slug]) }}">
                        {{ $course->name }}
                    </a>
                </p>
                <h1 class="lg:text-4xl text-3xl mb-5">{{ $lesson->name }}</h1>
                <div class="text-sm/relaxed tracking-wider text-gray-600 mb-6">{!! $course->short_description !!}</div>
            </div>
        </div>

        <div class="lg:col-span-4 self-start lg:mb-5 lg:sticky lg:top-52" x-data="{ expanded: false }">
            <div class="card border border-slate-200">
                <div class="card-body text-slate-500 overflow-hidden relative"
                     x-bind:class="expanded ? '' : 'max-h-[250px]'" x-transition.enter.duration.500ms
                     x-transition.leave.duration.300ms>
                    <h2 class="text-slate-800 text-base mb-2">{{ $step->name }}</h2>
                    <hr class="my-3">
                    <div class="flex flex-col gap-4">
                        <div class="relative transition-all duration-300">
                            @foreach ($step->childs->sortBy('sort_order') as $index => $les)
                                <x-front::lesson.list :course="$course" :progress="$progress" :step="$step"
                                                      :lesson="$les" />
                            @endforeach
                        </div>
                    </div>
                </div>
                <hr class="">
                <div class="py-3 text-center bg-slate-100">
                    <a class="ml-auto text-slate-600/75 hover:text-slate-600" href="javascript:void(0)"
                       x-on:click="expanded = !expanded">
                        <span class="text-sm" x-text="expanded ? 'Sembunyikan' : 'Lihat semua'"></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            class IntervalTimer {
                callbackStartTime;
                remaining = 0;
                paused = false;
                timerId = null;
                _callback;
                _delay;

                constructor(callback, delay) {
                    this._callback = callback;
                    this._delay = delay;
                }

                pause() {
                    if (!this.paused) {
                        this.clear();
                        this.remaining = new Date().getTime() - this.callbackStartTime;
                        this.paused = true;
                    }
                }

                resume() {
                    if (this.paused) {
                        if (this.remaining) {
                            setTimeout(() => {
                                this.run();
                                this.paused = false;
                                this.start();
                            }, this.remaining);
                        } else {
                            this.paused = false;
                            this.start();
                        }
                    }
                }

                clear() {
                    clearInterval(this.timerId);
                }

                start() {
                    this.clear();
                    this.timerId = setInterval(() => {


                        this.run();
                    }, this._delay);
                }

                run() {
                    this.callbackStartTime = new Date().getTime();
                    this._callback();
                }
            }


            function setCurrentSecond() {
                @this.dispatch('setLastWatch', {
                    second: player.currentTime.toFixed(0)
                })
            }

            const updateSecond = new IntervalTimer(setCurrentSecond, 10000);

            const player = window.player = new Plyr('#player', {
                tooltips: {
                    controls: true,
                    seek: true
                },
                youtube: {
                    noCookie: true,
                    controls: 0,
                    rel: 0,
                    showinfo: 0,
                    iv_load_policy: 3,
                    modestbranding: 1,
                    start: {{ optional($lesson_progress)->current_second ?: 0 }}
                },
                embed: {
                    seekTo: {{ optional($lesson_progress)->current_second ?: 0 }}
                }
            });

            player.on('playing', function(e) {
                if (updateSecond.paused) {
                    updateSecond.resume()
                } else {
                    updateSecond.start()
                }
            })

            player.on('pause', function(e) {
                updateSecond.pause()
            })

            player.on('stop', function(e) {
                updateSecond.pause()
            })

        })
    </script>
@endpush
