<?php

namespace Modules\Front\Livewire\Course;

use Exception;
use Livewire\Component;
use Modules\Course\Models\Course;
use Modules\Course\Models\CourseStep;
use Modules\Customer\Models\Customer;
use Modules\Front\Traits\Livewire\Ecommerce;
use Modules\Common\Traits\Utils\FlashMessage;
use Modules\Course\Models\CustomerCourseProgress;
use Modules\Course\Services\Repositories\CustomerCourseProgressRepo;

class ShowLesson extends Component
{
    use FlashMessage, Ecommerce;

    /**
     * Define customoer props
     * @var Customoer $customoer
     */
    public Customer $customer;

    /**
     * Define course props
     * @var Course $course
     */
    public Course $course;

    /**
     * Define course step props
     * @var CourseStep $step
     */
    public CourseStep $step;

    /**
     * Define course step props
     * @var CourseStep $lesson
     */
    public CourseStep $lesson;

    /**
     * Define string props
     * @var ?string
     */
    public ?string  $course_id;
    public ?string  $step_id;
    public ?string  $lesson_id;

    /**
     * Define bool props
     * @var CustomerCourseProgress $progress
     */
    public $progress;
    public $lesson_progress;

    protected $listeners = [
        'setLastWatch'
    ];

    /**
     * Define props value before component rendered
     * @return void
     */
    public function mount(Course $course, CourseStep $lesson)
    {
        $customer = auth('customer')->user();
        $progress = $customer->progress;
        $this->course = $course;
        $this->course_id = $course->id;
        $this->step = $lesson->step;
        $this->lesson = $lesson;
        $this->step_id = $lesson->parent_id;
        $this->lesson_id = $lesson->id;

        if ($customer) {
            $this->customer = $customer;
            self::setCourseProgress();
        }
    }

    /**
     * Set customer course progress
     * @return void
     */
    public function setCourseProgress()
    {
        $progress = $this->customer->progress()->get();
        $this->progress = $progress;
        $this->lesson_progress = $progress->where('step_id', $this->step_id)
            ->where('lesson_id', $this->lesson_id)
            ->first();
    }

    /**
     * Update customer current second  of lesson progress
     *
     * @param  int $second
     * @return void
     */
    public function setLastWatch($second)
    {
        try {
            $progress = $this->lesson_progress;
            $progress->update([
                'current_second' => $second
            ]);

            (new CustomerCourseProgressRepo)->validateLessonProgress($progress, $this->step, $this->lesson);
            self::setCourseProgress();
        } catch (Exception $exception) {
            $this->dispatchError($exception->getMessage());
        }
    }

    public function render()
    {
        return view('front::livewire.course.show-lesson');
    }
}
