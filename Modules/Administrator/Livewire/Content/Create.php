<?php

namespace Modules\Administrator\Livewire\Content;

use App\Livewire\Component\Editor;
use App\Livewire\Component\Filepond\Image;
use Exception;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;
use Modules\Common\Models\Content;
use Modules\Common\Services\Repositories\ContentRepo;

class Create extends Component
{
    // use WithImageFilepond, WithEditor;

    /**
     * Define query string props
     *
     * @var string
     */
    public $slug_group;
    public $key;
    public $label;
    public $value;
    public $type = "input";

    /**
     * Define event listeners
     *
     * @var array
     */
    public $listeners = [
        // Image::EVENT_VALUE_UPDATED,
        // Editor::EVENT_VALUE_UPDATED,
    ];

    public function mount()
    {
        $this->slug_group = request('slug_group') ?: null;
    }

    /**
     * Set validation rules
     *
     * @var array
     */
    protected function rules()
    {
        return [
            'slug_group' => 'required|max:191',
            'key' => 'required|max:191|unique:app_settings,key',
            'type' => 'required|max:191|in:image,input,textarea,editor',
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
        'label.regex' => 'format :attribute tidak diperbolehkan. :attribute hanya diperbolehkan huruf.',
        'price.regex' => 'format :attribute tidak diperbolehkan. :attribute hanya diperbolehkan angka.',
    ];

    /**
     * Set validation attributes name
     *
     * @var array
     */
    protected $validationAttributes = [
        'slug_group' => 'Group',
        'key' => 'Key',
        'label' => 'Label',
        'value' => 'Value',
        'type' => 'Type',
    ];

    /**
     * Livewire hooks, when search props has been updated
     * This method will be running
     *
     * @param  string $value
     * @return void
     */
    public function updated($property, $value)
    {
        if ($property == 'key') {
            $this->label = title(unslug($value));
        }

        if ($property == 'type') {
            $this->reset('value');
        }
    }

    /**
     * Hooks for description property
     * When editor editor has been updated,
     * Description property will be update
     *
     * @param  string $value
     * @return void
     */
    public function editor_value_updated($value)
    {
        $this->value = $value;
    }

    /**
     * Hooks for value property
     * When image-upload has been updated,
     * Value property will be update
     *
     * @param  string $value
     * @return void
     */
    public function images_value_updated($value)
    {
        $this->value = $value;
    }

    /**
     * Get all groups from database
     *
     * @return void
     */
    public function getGroups()
    {
        return (new ContentRepo())->getGroupField();
    }

    /**
     * Store content data to database
     *
     * @return void
     */
    public function store()
    {
        $validate = $this->rules();
        $validate['value'] = $this->type == 'image' ? 'required' : 'required';

        $this->validate($validate);

        $data = [
            'slug_group' => $this->slug_group,
            'key' => $this->key,
            'label' => $this->label,
            'value' => $this->value,
            'type' => $this->type,
        ];

        try {
            Content::create($data);

            Cache::forever($this->key, $this->value);

            $this->reset();
            $this->resetImageFilepond();

            return session()->flash('success', 'Pengaturan berhasil ditambahkan.');
        } catch (Exception $exception) {
            return session()->flash('error', $exception->getMessage());
        }
    }

    public function render()
    {
        return view('administrator::livewire.content.create', [
            'groups' => $this->getGroups(),
            'types' => [
                'input', 'image', 'textarea', 'editor',
            ],
        ]);
    }
}
