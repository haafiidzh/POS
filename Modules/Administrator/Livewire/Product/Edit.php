<?php

namespace Modules\Administrator\Livewire\Product;

use App\Livewire\Component\Editor;
use Exception;
use Livewire\Component;
use Modules\Common\Contracts\WithThirdParty;
use Modules\Common\Models\Category;
use Modules\Common\Models\Product;
use Modules\Common\Traits\Utils\FlashMessage;
use Modules\Core\Http\Livewire\Component\Filepond\Image;

class Edit extends Component
{
    use WithThirdParty, FlashMessage;

    /**
     * Define Product props
     * @var Product $product
     */
    public Product $product;

    /**
     * Define string properties
     * @var string
     */
    public ?string $product_id = '';
    public ?string $oldThumbnail = '';
    public ?string $published_at = '';
    public ?string $published_by = '';
    public ?string $title = '';
    public ?string $slug_title = '';
    public ?string $subject = '';
    public ?string $description = '';
    public ?string $thumbnail = '';
    public ?string $thumbnail_source = '';
    public ?string $type = 'products';
    public ?string $tags = '';
    public ?string $price = '';


    /**
     * Define int properties
     * @var int
     */
    public ?int $category = null;

    /**
     * Define bool properties
     * @var bool
     */
    public ?bool $publish = true;
    public ?bool $archived = false;

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
     * Define properties value before component rendered
     *
     * @param  Product $product
     * @return void
     */
    public function mount(Product $product)
    {
        $this->product = $product;
        $this->product_id = $product->id;
        $this->category = $product->category_id;
        $this->type = $product->type_id;
        $this->tags = $product->tags;
        $this->title = $product->title;
        $this->price = $product->price;
        $this->slug_title = $product->slug_title;
        $this->description = $product->description;
        $this->oldThumbnail = $product->thumbnail ?: cache('image_not_found');
        $this->published_at = $product->published_at;
        $this->published_by = $product->published_by;

        if ($product->published_at == null && $product->archived_at == null) {
            $this->publish = false;
        } else if ($product->published_at != null && $product->archived_at == null) {
            $this->publish = true;
        } else if ($product->published_by != null && $product->archived_at != null) {
            $this->archived = true;
        }
    }

    /**
     * Define validation rules
     * @return array
     */
    protected function rules()
    {
        return [
            'thumbnail' => 'nullable',
            'category' => 'required',
            'title' => 'required|max:191|unique:products,title,' . $this->product_id . ',id',
            'slug_title' => 'required|max:191|unique:products,slug_title,' . $this->product_id . ',id',
            'tags' => 'nullable|max:191',
            'description' => 'required',
            'price' => 'required',

        ];
    }

    /**
     * Define validation message
     * @return array
     */
    protected function messages()
    {
        return [
            'tags.max' => 'The tags has reached its maximum point.',
            'description.required' => 'The content field is required.',
        ];
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

    /**
     * Hooks for title property
     * Doing title validation after
     * Title property has been updated
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
     * Get all categories and filter by Product type
     *
     * @return void
     */
    public function getCategories()
    {
        return Category::where('group', 'like', '%products%')->whereNull('parent_id')->get();
    }

    /**
     * Update Product to database
     *
     * @return void
     */
    public function update()
    {
        // Validation
        $this->validate();

        try {
            $data = [
                'title' => $this->title,
                'slug_title' => $this->slug_title,
                'category_id' => $this->category,
                'type' => $this->type,
                'subject' => $this->subject,
                'description' => $this->description,
                'tags' => $this->tags,
                'price' => $this->price,

            ];

            // publish
            if ($this->publish) {
                $data['published_by'] = user('id');
                $data['published_at'] = $this->product->published_at ?: now()->toDateTimeString();
                $data['archived_at'] = null;
            } else {
                $data['published_at'] = null;
                $data['archived_at'] = null;
            }

            // archived
            if ($this->archived) {
                $data['published_at'] = null;
                $data['archived_at'] = now()->toDateTimeString();
            }

            if ($this->thumbnail) {
                $data['thumbnail'] = $this->thumbnail;
            }

            $this->product->update($data);

            return $this->dispatchSuccess('Produk berhasil diperbarui.');

        } catch (Exception $exception) {
            return $this->dispatchError($exception->getMessage());

        }

    }

    public function render()
    {
        return view('administrator::livewire.product.edit', [
            'categories' => self::getCategories(),
        ]);
    }
}
