<div class="grid lg:grid-cols-12 grid-cols-1 gap-10 items-center" id="scrollTarget">
    <div class="lg:col-span-8">
        <div wire:ignore>
            <livewire:front::course.show.course :course="$course" />
        </div>
        <livewire:front::course.show.lesson :course="$course" :has-course="$hasCourse" :customer="$customer" />

        <hr class="my-10">
        <livewire:front::course.show.review :course="$course" />

        @if ($hasCourse && $canWriteReview)
            <hr class="my-10">
            <livewire:front::course.show.write-review :course_id="$course->id" :customer_id="$customer->id" />
        @elseif ($hasCourse && !$canWriteReview)
            <hr class="my-10">
            <section class="card mb-24">
                <h2 class="text-2xl mb-4">Berikan Ulasan</h2>
                <div class="p-6 text-center border rounded">
                    kamu telah memberikan ulasan pada kelas {{ $course->name }}.
                </div>
            </section>
        @else
            <div class="mb-20"></div>
        @endif
    </div>

    <div class="lg:col-span-4 self-start lg:sticky lg:top-20">
        <x-front::widget.checkout :course="$course" :has-course="$hasCourse" />
    </div>

    <x-front::widget.checkout-mobile :course="$course" :has-course="$hasCourse" />
</div>
