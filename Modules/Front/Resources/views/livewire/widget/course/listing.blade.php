<section class="relative">
    <div class="container">
        <div class="grid grid-cols-1 sm:grid-cols-2 justify-between my-6">
            <div class="col-span-1 self-center">
                <h4 class="text-base text-gray-800">Your Courses</h4>
            </div>
            <div class="col-span-1 grid grid-cols-5 gap-2">
                <input type="text" class="form-input col-span-3" placeholder="Mau cari kelas apa?"
                       wire:model.lazy="search">
                <select name="sort" id="sort" class="form-input col-span-2" wire:model.live="sort">
                    @foreach ($sort_order as $order)
                        <option value="{{ $order['value'] }}">{{ $order['label'] }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="flex flex-col gap-y-2 w-full mb-4">
            @forelse ($courses as $item)
                @php
                    $lesson_progress_count = $item->lesson_progress_count;
                    $lessons_count = $item->lessons_count;
                    $progress = round(($lesson_progress_count / $lessons_count) * 100, 2) . '%';
                @endphp
                <div class="bg-white">
                    <div class="p-6">
                        <div class="grid grid-cols-2 lg:grid-cols-10  items-center sm:justify-between gap-4">
                            <div class="col-span-2 lg:col-span-5 lg:pr-6">
                                <p class="font-semibold text-slate-700 mb-1">
                                    {{ $item->course_name }}
                                </p>

                                <p class="text-sm text-slate-400">{{ $item->course_short_description }}</p>
                            </div>
                            <div class="col-span-2 lg:col-span-3">
                                <div class="mb-1">
                                    <span
                                          class="inline-flex items-center gap-1.5 py-1 px-2 rounded-md text-xs bg-slate-200 text-slate-700 font-semibold">
                                        {{ $item->category_name }}
                                    </span>

                                    <div class="inline-flex">
                                        <div
                                             class="inline-flex items-center gap-1.5 py-1 px-2 rounded-md text-xs bg-slate-200 text-slate-700 font-semibold gap-1 text-xs">
                                            <i
                                               class="bx bx-book-bookmark"></i>{{ $lesson_progress_count . '/' . $lessons_count }}
                                        </div>
                                    </div>
                                </div>
                                <div
                                     class="flex w-full h-3 bg-gray-200 rounded-full overflow-hidden dark:bg-gray-700 relative">
                                    <div class="flex flex-col justify-center overflow-hidden bg-green-500"
                                         role="progressbar" style="width: {{ $progress }}" aria-valuenow="25"
                                         aria-valuemin="0" aria-valuemax="100">
                                    </div>
                                    <span
                                          class="absolute left-1/2 top-1/2 translate-x-[-50%] translate-y-[-50%] text-[8px]">{{ $progress }}</span>
                                </div>
                            </div>
                            <div class="col-span-2 flex gap-2 justify-end">
                                <a href="{{ route('front.course.show-course', [
                                    'course' => $item->course_slug,
                                ]) }}"
                                   class="btn outline-primary py-2 text-sm">
                                    Lihat Kelas
                                </a>
                                @if ($item->is_complete && $item->certificate_id)
                                    <div x-data="{
                                        open: false,
                                        toggle() {
                                            if (this.open) {
                                                return this.close()
                                            }
                                            this.$refs.button.focus()
                                            this.open = true
                                        },
                                        close(focusAfter) {
                                            if (!this.open) return
                                            this.open = false
                                            focusAfter && focusAfter.focus()
                                        }
                                    }" x-on:keydown.escape.prevent.stop="close($refs.button)"
                                         x-on:focusin.window="! $refs.panel.contains($event.target) && close()"
                                         x-id="['dropdown-button']" class="relative">
                                        <!-- Button -->
                                        <button class="btn outline-primary py-2 text-sm" x-ref="button"
                                                x-on:click="toggle()" :aria-expanded="open"
                                                :aria-controls="$id('dropdown-button')" type="button">
                                            Sertifikat
                                        </button>

                                        <!-- Panel -->
                                        <div x-ref="panel" x-show="open" x-transition.origin.top.right
                                             x-on:click.outside="close($refs.button)" :id="$id('dropdown-button')"
                                             style="display: none;"
                                             class="absolute right-0 mt-2 w-40 rounded-md bg-white shadow-md z-20">
                                            <a href="{{ route('front.accomplishment.certificate', [
                                                'certificate_id' => $item->certificate_id,
                                                'mode' => 'preview',
                                            ]) }}"
                                               class="flex items-center gap-2 w-full first-of-type:rounded-t-md last-of-type:rounded-b-md px-4 py-2.5 text-left text-sm hover:bg-gray-50 disabled:text-gray-500"
                                               target="_blank">
                                                Lihat
                                            </a>
                                            <a href="{{ route('front.accomplishment.certificate', [
                                                'certificate_id' => $item->certificate_id,
                                                'mode' => 'download',
                                            ]) }}"
                                               class="flex items-center gap-2 w-full first-of-type:rounded-t-md last-of-type:rounded-b-md px-4 py-2.5 text-left text-sm hover:bg-gray-50 disabled:text-gray-500"
                                               target="_blank">
                                                Download
                                            </a>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <x-front::utils.404 class="border">
                    Upsss... Sepertinya kami tidak menemukan kelas yang kamu Cari. Coba cari menggunakan filter
                    yang lain.
                </x-front::utils.404>
            @endforelse
        </div>

        {{ $courses->onEachSide(0)->links('livewire::front-tailwind') }}
    </div>
</section>
