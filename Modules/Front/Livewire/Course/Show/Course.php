<?php

namespace Modules\Front\Livewire\Course\Show;

use Livewire\Component;
use Modules\Course\Models\Course as CourseModel;

class Course extends Component
{
    /**
     * Define course props
     * @var Course $course
     */
    public CourseModel $course;

    /**
     * Define props value before component rendered
     * @return void
     */
    public function mount(CourseModel $course)
    {
        $this->course = $course;
    }

    public function render()
    {
        return view('front::livewire.course.show.course');
    }
}
