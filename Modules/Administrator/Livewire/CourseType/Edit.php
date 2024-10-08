<?php

namespace Modules\Administrator\Livewire\CourseType;

use Exception;
use Livewire\Component;
use Modules\Common\Contracts\WithModal;
use Modules\Common\Traits\Utils\FlashMessage;
use Modules\Course\Models\CourseType;

class Edit extends Component
{
    use WithModal, FlashMessage;

    /**
     * Define type props
     * @var CourseType $type
     */
    public CourseType $type;

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
    public ?int $type_id = null;
    public ?int $sort_order = null;

    /**
     * Define bool props
     * @var bool
     */
    public ?bool $is_active = true;

    /**
     * Set validation rules
     *
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
     *
     * @var array
     */
    protected $messages = [
        '*.required' => ':attribute tidak boleh kosong',
        '*.email' => 'format :email tidak sesuai',
        '*.min' => 'form :attribute min. :min karakter',
        '*.max' => 'form :attribute maks. :max karakter',
    ];

    /**
     * Set validation attributes name
     *
     * @var array
     */
    protected $validationAttributes = [
        'name' => 'Nama',
        'slug' => 'Slug',
        'description' => 'Deskripsi',
        'is_active' => 'Status',
    ];

    /**
     * Define livewire event listeners
     * @var array
     */
    protected $listeners = [
        'editCourseType',
        self::INIT_MODAL,
        self::CLOSE_MODAL,
    ];

    /**
     * Define props value before component rendered
     *
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
     * Livewire hook for edit type event
     *
     * @param  int|null $id
     * @return void
     */
    public function editCourseType(?int $id)
    {

        try {
            $type = CourseType::find($id);

            if (!$type) {
                throw new Exception('Tipe kelas tidak ditemukan, tipe gagal dimuat.');
            }

            $this->type = $type;
            $this->type_id = $type->id;
            $this->name = $type->name;
            $this->slug = $type->slug;
            $this->description = $type->description;
            $this->is_active = $type->is_active;
            $this->loading = false;

        } catch (Exception $exception) {
            $this->loading = false;
            return $this->dispatchError($exception->getMessage());
        }
    }

    /**
     * Update type data to database
     *
     * @return void
     */
    public function update()
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'is_active' => $this->is_active ? 1 : 0,
        ];

        try {
            $type = CourseType::find($this->type_id);
            $type->update($data);

            return $this->dispatchSuccess('Tipe kelas berhasil diperbarui.');
        } catch (Exception $exception) {
            return $this->dispatchError($exception->getMessage());
        }
    }

    public function render()
    {
        return view('administrator::livewire.course-type.edit');
    }
}
