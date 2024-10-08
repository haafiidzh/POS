<?php

namespace Modules\Front\Livewire\Course\Show;

use Livewire\Component;
use Modules\Course\Models\Course;
use Modules\Customer\Models\Customer;

class Lesson extends Component
{
    /**
     * Define customer props
     * @var $customer
     */
    public $customer;

    /**
     * Define course props
     * @var Course $course
     */
    public Course $course;

    /**
     * Define props value before component rendered
     * @return void
     */
    public function mount(Course $course, $customer)
    {
        $this->course = $course;

        if ($customer) {
            $this->customer = $customer;
        }
    }

    public function render()
    {
        return view('front::livewire.course.show.lesson', [
            'progress' => optional($this->customer)->progress,
        ]);
    }
}
