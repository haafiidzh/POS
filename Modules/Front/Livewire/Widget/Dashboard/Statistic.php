<?php

namespace Modules\Front\Livewire\Widget\Dashboard;

use Livewire\Component;
use Modules\Course\Models\CustomerCourse;
use Modules\Customer\Models\Customer;

class Statistic extends Component
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
     * Count customer course
     * @return collection
     */
    public function countCustomerCourse()
    {

        $customer_courses = CustomerCourse::select('id', 'is_complete')->where('customer_id', $this->customer_id)->get();
        $total_courses = $customer_courses->count();
        $total_complete_courses = $customer_courses->where('is_complete', 1)->count();

        return collect([
            'total_courses' => $total_courses,
            'total_complete_courses' => $total_complete_courses,
            'percentage' => $total_courses > 0 ? round(($total_complete_courses / $total_courses) * 100, 2) . '%' : 0 . '%',
        ]);
    }

    /**
     * Get latest lessons
     * @return CustomerCourseProgress
     */
    public function latestLessons()
    {
        return $this->customer->progress()
            ->with('course:id,name,slug', 'lesson:id,name,slug,total_seconds')
            ->where('current_second', '>', 0)
            ->orderBy('updated_at', 'desc')
            ->limit(2)
            ->get();
    }

    public function render()
    {
        return view('front::livewire.widget.dashboard.statistic', [
            'course_progress' => self::countCustomerCourse(),
            'latest_lessons' => self::latestLessons(),
        ]);
    }
}
