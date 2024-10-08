<?php

namespace Modules\Front\Livewire\Course;

use Exception;
use Livewire\Component;
use Modules\Front\Traits\Livewire\Ecommerce;
use Modules\Common\Traits\Utils\FlashMessage;
use Modules\Course\Services\Repositories\CourseRepo;

class Latest extends Component
{
    use Ecommerce, FlashMessage;

    /**
     * Define string property
     * @var string
     */
    public string $sort = 'newest';

    /**
     * Define int property
     * @var int
     */
    public int $per_page = 5;

    /**
     * Get all public courses
     * @return Paginator
     */
    public function getAll()
    {
        try {
            // return (new CourseRepo)->getPublicCourses((object) [
            //     'sort' => $this->sort,
            //     'paginated' => false
            // ], $this->per_page);
            throw new Exception();
        } catch (\Exception $e) {
            return collect([]);
        }
    }

    public function render()
    {
        return view('front::livewire.course.latest', [
            'datas' => self::getAll(),
        ]);
    }
}