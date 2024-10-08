<?php

namespace Modules\Front\Livewire\Widget\Dashboard;

use Livewire\Component;
use Modules\Course\Models\CustomerCourse;
use Modules\Customer\Models\Customer;

class Course extends Component
{
    /**
     * Define customer props
     * @var Customer $customer
     */
    public Customer $customer;

    /**
     * Define string props
     * @var ?string
     */
    public string $customer_id;

    /**
     * Define props value before component rendered
     *
     * @param Customer $customer
     * @return void
     */
    public function mount(Customer $customer)
    {
        $this->customer = $customer;
        $this->customer_id = $customer->id;
    }

    /**
     * Get latest customer course
     * @return CustomerCourse
     */
    public function getCustomerCourses()
    {
        return CustomerCourse::rightJoin('courses', 'courses.id', '=', 'customer_course.course_id')
            ->rightJoin('categories', 'categories.id', '=', 'courses.category_id')
            ->select([
                'customer_course.*',
                'courses.id AS course_id',
                'courses.name AS course_name',
                'courses.slug AS course_slug',
                'courses.short_description AS course_short_description',
                'categories.id AS category_id',
                'categories.name AS category_name',
                'categories.slug AS category_slug',
            ])
            ->where('customer_id', $this->customer_id)
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();
    }

    public function render()
    {
        return view('front::livewire.widget.dashboard.course', [
            'courses' => self::getCustomerCourses(),
        ]);
    }
}
