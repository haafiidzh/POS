<?php

namespace Modules\Administrator\Livewire\CourseType;

use Exception;
use Livewire\Component;
use Livewire\WithPagination;
use Modules\Administrator\Livewire\CourseCourseType\Create;
use Modules\Administrator\Livewire\CourseType\Edit;
use Modules\Common\Contracts\WithRemoveModal;
use Modules\Common\Traits\Utils\FlashMessage;
use Modules\Course\Models\CourseType;
use Modules\Course\Services\Repositories\CourseTypeRepo;

class Table extends Component
{
    use WithPagination, WithRemoveModal, FlashMessage;

    /**
     * Define string props
     * @var string
     */
    public ?string $sort = 'sort_order';
    public ?string $order = 'asc';
    public ?string $group = 'courses';
    public ?string $destroyId = '';
    public ?string $search = '';

    /**
     * Define int props
     * @var int
     */
    public $per_page = 10;

    /**
     * Define query string used
     * in this component
     *
     * @var array
     */
    protected $queryString = [
        'search',
    ];

    /**
     * Define livewire event listeners
     * @var array
     */
    protected $listeners = [
        self::CANCEL,
        self::DESTROY,
        self::FLASH => '$refresh',
    ];

    /**
     * To handle perpage pagination
     *
     * @param  mixed $total
     * @return void
     */
    public function updatedPerPage($total)
    {
        $this->resetPage();
        $this->per_page = $total;
    }

    /**
     * Get all data from resource
     *
     * @return void
     */
    public function getAll()
    {
        return (new CourseTypeRepo())->filters((object) [
            'search' => $this->search,
            'sort' => $this->sort,
            'order' => $this->order,
            'group' => $this->group,
        ]);
    }

    /**
     * Update banner position while drag n drop
     *
     * @param  mixed $list
     * @return void
     */
    public function updateOrder($list)
    {
        foreach ($list as $item) {
            CourseType::find($item['value'])->update([
                'sort_order' => $item['order'],
            ]);
        }
    }

    /**
     * Edit category or sub category
     * Dispatch to create category class
     *
     * @param  int|null $id
     * @return void
     */
    public function edit(?int $id)
    {
        return $this->dispatch('editCourseType', $id)->to(Edit::class);
    }

    /**
     * Updated callback
     * Listen from another component event
     *
     * @return void
     */
    public function updated($property = null, $value = null)
    {
        if ($property !== 'destroyId') {
            $this->resetPage();
        }

        if ($property && !$value) {
            $this->reset($property);
        }
    }

    /**
     * Destroy category from resource
     *
     * @return void
     */
    public function destroy()
    {
        try {
            $category = CourseType::find($this->destroyId);

            if (!$category) {
                throw new Exception('Tipe kelas tidak ditemukan, tipe gagal dihapus.');
            }

            $category->delete();
            $this->reset('destroyId');

            return $this->dispatchSuccess('Tipe kelas berhasil dihapus.', true);
        } catch (Exception $exception) {
            $this->reset('destroyId');
            return $this->dispatchError($exception->getMessage(), true);
        }
    }

    public function render()
    {
        return view('administrator::livewire.course-type.table', [
            'types' => $this->getAll(),
        ]);
    }
}
