<?php

namespace Modules\Front\Livewire\Widget\Course;

use stdClass;
use Livewire\Component;
use Livewire\WithPagination;
use function Laravel\Prompts\search;

use Modules\Customer\Models\Customer;
use Modules\Course\Models\CustomerCourse;

class Listing extends Component
{
    use WithPagination;

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
    public ?string $search = '';
    public ?string $sort = 'newest';

    /**
     * Define int props
     * @var ?int
     */
    public int $per_page = 10;

    /**
     * Define livewire query string
     * @var array
     */
    protected $queryString = [
        'search', 'sort'
    ];

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
        $this->search = request('search') ?: null;
        $this->sort = request('sort') ?: null;
    }

    /**
     * Hooks for all properties
     *
     * @param  string $component
     * @param  string $value
     * @return void
     */
    public function updated($property, $value)
    {
        $this->resetPage();
        $this->js('document.querySelector(\'#scrollTarget\').scrollIntoView({behavior: \'smooth\' })');
    }

    /**
     * Define sort order (filter)
     * @return array
     */
    public function sortOrder()
    {
        return [
            [
                'value' => 'name-a-z',
                'label' => 'Nama A-Z',
            ],
            [
                'value' => 'name-z-a',
                'label' => 'Nama Z-A',
            ],
            [
                'value' => 'newest',
                'label' => 'Terbaru',
            ],
            [
                'value' => 'oldest',
                'label' => 'Terlama',
            ],
        ];
    }

    /**
     * Get latest customer course
     * @return Paginator
     */
    public function getCustomerCourses()
    {
        $sort = self::switchSort($this->sort);
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
            ->when($this->search, function ($query) {
                return $query->where('courses.name', 'like', '%' . $this->search . '%')
                    ->orWhere('courses.short_description', 'like', '%' . $this->search . '%')
                    ->orWhere('categories.name', 'like', '%' . $this->search . '%');
            })
            ->orderBy($sort->sort, $sort->order)
            ->paginate($this->per_page);
    }

    /**
     * Switch sort parameter from string to object
     *
     * @param  string $request
     * @return object
     */
    public function switchSort($request)
    {
        $response = new stdClass;
        switch ($request) {
            case 'name-a-z':
                $response->sort = 'courses.name';
                $response->order = 'asc';
                return $response;
                break;

            case 'name-z-a':
                $response->sort = 'courses.name';
                $response->order = 'desc';
                return $response;
                break;

            case 'newest':
                $response->sort = 'customer_course.created_at';
                $response->order = 'desc';
                return $response;
                break;

            case 'oldest':
                $response->sort = 'customer_course.created_at';
                $response->order = 'asc';
                return $response;
                break;

            default:
                $response->sort = 'customer_course.created_at';
                $response->order = 'desc';
                return $response;
                break;
        }
    }


    public function render()
    {
        return view('front::livewire.widget.course.listing', [
            'courses' => (self::getCustomerCourses()),
            'sort_order' => self::sortOrder(),
        ]);
    }
}
