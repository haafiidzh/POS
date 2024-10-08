<?php

namespace Modules\Front\Livewire\Course;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\Common\Contracts\WithThirdParty;
use Modules\Common\Livewire\Utils\Tagify\Dropdown;
use Modules\Common\Models\Category;
use Modules\Common\Traits\Utils\FlashMessage;
use Modules\Course\Models\CourseType;
use Modules\Course\Services\Repositories\CourseRepo;
use Modules\Front\Traits\Livewire\Ecommerce;
use stdClass;

class Listing extends Component
{
    use WithPagination, WithThirdParty, Ecommerce, FlashMessage;

    /**
     * Define string property
     * @var string|null
     */
    public ?string $search = '';
    public ?string $category = '';
    public ?string $course_payment = '';
    public ?string $course_type = '';
    public ?string $sort = 'newest';

    /**
     * Define int property
     * @var int|null
     */
    public ?int $per_page = 10;

    /**
     * Define bool property
     * @var bool|null
     */
    public ?bool $is_course_category_route = false;

    /**
     * Define array property
     * @var array|null
     */
    public ?array $price = [
        'from' => null,
        'to' => null,
    ];

    /**
     * Define livewire query string
     * @var array
     */
    protected $queryString = [
        'search', 'category', 'sort'
    ];

    /**
     * Define props value before component rendered
     * @return void
     */
    public function mount()
    {
        $this->search = request('search') ?: null;
        $this->sort = request('sort') ?: null;
        $this->category = request('category') ?: null;
        $this->is_course_category_route = request()->routeIs('front.course.category') ? true : false;
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
                'value' => 'best-seller',
                'label' => 'Terlaris',
            ],
            [
                'value' => 'lowest-price',
                'label' => 'Termurah',
            ],
            [
                'value' => 'highest-price',
                'label' => 'Termahal',
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
     * Get all public courses
     * @return Paginator
     */
    public function getAll()
    {
        return (new CourseRepo)->getPublicCourses((object) [
            'search' => $this->search,
            'category' => $this->category,
            'course_payment' => $this->course_payment,
            'course_type' => $this->course_type,
            'sort' => $this->sort,
            // 'search' => $this->search,
        ], $this->per_page);
    }

    /**
     * Get all course categories
     * @return Category
     */
    public function getCourseCategories()
    {
        return Category::query()
            ->with('childs')
            ->active()
            ->select(['id', 'parent_id', 'name', 'slug'])
            ->whereNull('parent_id')
            ->where('group', 'courses')
            ->orderBy('sort_order')
            ->limit(10)
            ->get();
    }

    /**
     * Get all course types
     * @return Category
     */
    public function getCourseTypes()
    {
        $prepend = new stdClass;
        $prepend->name = 'Semua Jenis Kelas';
        $prepend->slug = '';
        $types = CourseType::query()->select(['name', 'slug'])
            ->active()
            ->get();

        return $types->prepend($prepend);
    }

    /**
     * Define payment types
     * @return array
     */
    public function paymentTypes()
    {
        return [
            [
                'value' => '',
                'label' => 'Semua Jenis Pembayaran'
            ],
            [
                'value' => 'unpaid',
                'label' => 'Gratis'
            ],
            [
                'value' => 'paid',
                'label' => 'Berbayar'
            ],
        ];
    }

    /**
     * Hooks for apply filter
     * @return void
     */
    public function applyFilter()
    {
        $this->resetPage();
    }

    /**
     * Reset all filter property
     * @return void
     */
    public function resetFilter()
    {
        $this->reset(
            'search',
            'category',
            'course_payment',
            'course_type',
            'sort',
        );

        $this->dispatch('filter-reset', [
            'input[name="search"]' => $this->search,
            'select[name="category"]' => $this->category,
            'input[type="radio"][name="payment"]' => $this->course_payment,
            'input[type="radio"][name="type"]' => $this->course_type,
            'select[name="sort"]' => $this->sort,
        ]);
    }

    public function render()
    {
        return view('front::livewire.course.listing', [
            'datas' => self::getAll(),
            'sort_order' => self::sortOrder(),
            'categories' => self::getCourseCategories(),
            'payment_types' => self::paymentTypes(),
            'course_types' => self::getCourseTypes()
        ]);
    }
}
