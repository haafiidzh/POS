<?php

namespace Modules\Front\Livewire\Course\Show;

use stdClass;
use Livewire\Component;
use Livewire\WithPagination;
use Modules\Course\Models\Course;
use Modules\Customer\Models\Customer;
use Modules\Course\Models\CourseReview;
use Modules\Common\Contracts\WithThirdParty;

class Review extends Component
{
    use WithPagination, WithThirdParty;

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
    public ?string  $sort = 'newest';
    public ?string  $message = '';

    /**
     * Define int props
     * @var ?int
     */
    public ?int $per_page = 5;
    public ?int $rating = 0;

    /**
     * Define props value before component rendered
     * @return void
     */
    public function mount(Course $course)
    {
        $this->course = $course;
        $this->course_id = $course->id;
    }

    /**
     * Get all reviews from resource
     * @return Paginator
     */
    public function getAllReviews()
    {
        return CourseReview::withoutGlobalScope('customer')->with('customer')
            ->where('course_id', $this->course_id)
            ->sort(self::switchSort($this->sort))
            ->paginate($this->per_page);
    }

    /**
     * Load more reviews
     * @return void
     */
    public function loadMore()
    {
        $this->per_page += 5;
    }

    /**
     * Switch sort by name
     *
     * @param  ?string $request
     * @return object
     */
    public function switchSort(?string $request)
    {
        $response = new stdClass;
        switch ($request) {

            case 'lowest-rating':
                $response->sort = 'rating';
                $response->order = 'asc';
                return $response;
                break;

            case 'highest-rating':
                $response->sort = 'rating';
                $response->order = 'desc';
                return $response;
                break;

            case 'newest':
                $response->sort = 'created_at';
                $response->order = 'desc';
                return $response;
                break;

            case 'oldest':
                $response->sort = 'created_at';
                $response->order = 'asc';
                return $response;
                break;

            default:
                $response->sort = 'created_at';
                $response->order = 'asc';
                return $response;
                break;
        }
    }


    /**
     * Define sort order (filter)
     * @return array
     */
    public function sortOrder()
    {
        return [
            [
                'value' => 'lowest-rating',
                'label' => 'Rating Terburuk',
            ],
            [
                'value' => 'highest-rating',
                'label' => 'Rating Terbaik',
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

    public function render()
    {
        return view('front::livewire.course.show.review', [
            'reviews' => self::getAllReviews(),
            'sort_order' => self::sortOrder()
        ]);
    }
}
