<?php

namespace Modules\Front\Livewire\Course;

use Exception;
use Livewire\Component;
use Modules\Course\Models\Course;
use Modules\ECommerce\Models\Cart;
use Illuminate\Support\Facades\URL;
use Modules\Customer\Models\Customer;
use Modules\ECommerce\Models\CartItem;
use Modules\Front\Traits\Livewire\Ecommerce;
use Modules\Common\Traits\Utils\FlashMessage;
use Modules\ECommerce\Services\Repositories\CartRepo;

class Show extends Component
{
    use FlashMessage, Ecommerce;

    /**
     * Define customer props
     * @var Customer $customer
     */
    public Customer $customer;

    /**
     * Define course props
     * @var Course $course
     */
    public Course $course;

    /**
     * Define string props
     * @var ?string
     */
    public ?string  $course_id;

    /**
     * Define bool props
     * @var ?bool
     */
    public ?bool  $hasCourse = false;
    public ?bool  $canWriteReview = false;

    /**
     * Livewire event listeners
     * @var array
     */
    protected $listeners = [
        'createdReview' => 'setPermission'
    ];

    /**
     * Define props value before component rendered
     * @return void
     */
    public function mount(Course $course)
    {
        $customer = auth('customer')->user();
        $this->course = $course;
        $this->course_id = $course->id;
        if ($customer) {
            $this->customer = $customer;
            self::setPermission();
        }
    }

    /**
     * Validate customer permissions
     * @return void
     */
    public function setPermission()
    {
        $this->hasCourse = $this->customer->hasCourse($this->course_id);
        $this->canWriteReview = $this->customer->canWriteReview($this->course_id);
    }

    public function render()
    {
        return view('front::livewire.course.show');
    }
}
