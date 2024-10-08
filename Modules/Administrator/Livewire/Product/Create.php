<?php

namespace Modules\Administrator\Livewire\Product;


use Exception;
use Illuminate\Support\Str;
use Livewire\Component;
use Modules\Common\Contracts\WithThirdParty;
use Modules\Common\Models\Category;
use Modules\Common\Models\Product;
use Modules\Common\Traits\Utils\FlashMessage;

class Create extends Component
{
    use WithThirdParty, FlashMessage;

    /**
     * Define string props
     * @var string
     */
    public ?string $title = null;
    public ?string $slug_title = null;
    public ?string $subject = null;
    public ?string $description = null;
    public ?string $thumbnail = null;
    public ?string $thumbnail_source = null;
    public string $type = 'product';
    public ?string $tags = null;
    public ?string $price = null;


    /**
     * Define int props
     * @var int
     */
    public ?int $category = null;

    /**
     * Define bool props
     * @var bool
     */
    public ?bool $publish = true;

    /**
     * Define event listeners
     * @var array
     */
    public $listeners = [
        self::UPDATED_EDITOR,
        self::UPDATED_FILEPOND,
        self::UPDATED_TAGIFY_TAG,
    ];

    /**
     * Define validation rules
     * @return void
     */
    protected function rules()
    {
        return [
            'thumbnail' => 'required',
            'category' => 'required',
            'title' => 'required|max:191|unique:products,title',
            'slug_title' => 'required|max:191|unique:products,slug_title',
            'tags' => 'nullable|max:191',
            'subject' => 'nullable|max:191',
            'description' => 'nullable',
            'price' => 'required',
        ];
    }

    /**
     * Define validation message
     * @return void
     */
    protected function messages()
    {
        return [
            'tags.max' => 'The tags has reached its maximum point.',
            'description.required' => 'The content field is required.',
        ];
    }

    /**
     * Hooks for title property
     * Doing title validation after
     * Title property has been crea
     *
     * @param  string $value
     * @return void
     */
    public function updatedTitle($value)
    {
        $this->slug_title = slug($value);
        $this->validate([
            'title' => 'required|max:191|unique:products,title',
            'slug_title' => 'required|max:191|unique:products,slug_title',
        ]);
    }

    /**
     * Hooks for slug_title property
     * Doing slug_title validation after
     * Slug_title property has been updated
     *
     * @param  string $value
     * @return void
     */
    public function updatedSlugTitle($value)
    {
        $this->validate([
            'slug_title' => 'required|max:191|unique:products,slug_title',
        ]);
    }

    /**
     * Hooks for description property
     * When editor editor has been updated,
     * Description property will be update
     *
     * @param  string $value
     * @return void
     */
    public function updatedEditor($value)
    {
        $this->description = $value;
    }

    /**
     * Hooks for thumbnail property
     * When image-upload has been updated,
     * Thumbnail property will be update
     *
     * @param  string $value
     * @return void
     */
    public function updatedFilepond($value)
    {
        $this->thumbnail = $value;
    }

    /**
     * Hooks for tags property
     * When tags has been updated,
     * Tags property will be update
     *
     * @param  string $value
     * @return void
     */
    public function updatedTagifyTag($value)
    {
        $this->tags = $value;
    }


    public function getCategories()
    {
        return Category::where('group', 'like', '%product%')->whereNull('parent_id')->get();
    }

    /**
     * Store post to database
     * @return void
     */
    public function store()
    {
        // Validation
        $this->validate();

        try {
            $data = [
                'id' => Product::generateId(),
                'title' => $this->title,
                'slug_title' => $this->slug_title,
                'category_id' => $this->category,
                'type' => $this->type,
                'description' => $this->description,
                'tags' => $this->tags,
                'price' => $this->price,
                'created_by' => user('id'),
            ];

            // publish
            if ($this->publish) {
                $data['published_by'] = user('id');
                $data['published_at'] = now()->toDateTimeString();
                $data['archived_at'] = null;
            } else {
                $data['published_at'] = null;
                $data['archived_at'] = null;
            }

            if ($this->thumbnail) {
                $data['thumbnail'] = $this->thumbnail;
            }

            Product::create($data);

            // Reset props
            $this->reset(
                'thumbnail',
                'title',
                'slug_title',
                'category',
                'subject',
                'description',
                'tags',
                'price',
                'publish'
            );

            // Reset third party
            $this->resetThirdParty();

            return $this->dispatchSuccess('Produk berhasil ditambahkan.');
        } catch (Exception $exception) {
            return $this->dispatchError($exception->getMessage());

        }
    }

    public function render()
    {
        return view('administrator::livewire.product.create', [
            'categories' => self::getCategories(),
        ]);
    }
}
