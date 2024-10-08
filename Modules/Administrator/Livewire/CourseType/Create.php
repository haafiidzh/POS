<?php

namespace Modules\Administrator\Livewire\CourseType;

use Exception;
use Livewire\Component;
use Modules\Common\Contracts\WithModal;
use Modules\Common\Traits\Utils\FlashMessage;
use Modules\Course\Models\CourseType;
use Modules\Course\Services\Repositories\CourseTypeRepo;

class Create extends Component
{
    use WithModal, FlashMessage;

    /**
     * Define string props
     * @var string
     */
    public ?string $name = '';
    public ?string $slug = '';
    public ?string $description = '';

    /**
     * Define int props
     * @var int
     */
    public ?int $sort_order = null;

    /**
     * Define bool props
     * @var bool
     */
    public ?bool $is_active = true;

    /**
     * Define livewire event listeners
     * @var array
     */
    protected $listeners = [
        self::INIT_MODAL,
        self::CLOSE_MODAL,
    ];

    /**
     * Set validation rules
     * @var array
     */
    protected function rules()
    {
        return [
            'name' => 'required|max:191',
            'slug' => 'required|max:191',
            'description' => 'nullable',
            'is_active' => 'nullable',
        ];
    }

    /**
     * Set validation messages
     * @var array
     */
    protected $messages = [
        '*.required' => ':attribute tidak boleh kosong',
        '*.min' => 'form :attribute min. :min karakter',
        '*.max' => 'form :attribute maks. :max karakter',
    ];

    /**
     * Set validation attributes
     * @var array
     */
    protected $validationAttributes = [
        'name' => 'Nama',
        'slug' => 'Slug',
        'description' => 'Deskripsi',
        'is_active' => 'Status',
    ];

    /**
     * Define props before component rendered
     *
     * @param  string|null $parent_id
     * @return void
     */
    public function mount()
    {
        //
    }

    /**
     * Livewire hooks, when search props has been updated
     * This method will be running
     *
     * @param  string $value
     * @return void
     */
    public function updatedName($value)
    {
        if ($value) {
            return $this->slug = slug($value);
        }

        return $this->reset('slug');
    }

    /**
     * Store coursetype data to database
     * @return void
     */
    public function store()
    {
        $this->validate();

        try {
            $parentLastPosition = (new CourseTypeRepo())->getLastPosition();
            $data = [
                'name' => $this->name,
                'slug' => $this->slug,
                'description' => $this->description,
                'is_active' => $this->is_active ? 1 : 0,
                'sort_order' => $parentLastPosition ? $parentLastPosition->sort_order + 1 : 1,
            ];

            CourseType::create($data);
            $this->reset();

            return $this->dispatchSuccess('Tipe kelas berhasil ditambahkan.');
        } catch (Exception $exception) {
            return $this->dispatchError($exception->getMessage());
        }
    }

    public function render()
    {
        return view('administrator::livewire.course-type.create');
    }
}
