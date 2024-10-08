<?php

namespace Modules\Front\Livewire\Blog;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\Common\Models\Category;
use Modules\Common\Contracts\WithThirdParty;
use Modules\Common\Services\Repositories\PostRepo;

class Listing extends Component
{
    use WithPagination, WithThirdParty;

    /**
     * Define string property
     * @var string|null
     */
    public ?string $search = '';
    public ?string $category = '';
    public ?string $tag = '';
    public ?string $sort = 'newest';

    /**
     * Define int property
     * @var int|null
     */
    public ?int $per_page = 10;

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
        $this->tag = request('tag') ?: null;
    }

    /**
     * Define sort order (filter)
     * @return array
     */
    public function sortOrder()
    {
        return [
            [
                'value' => 'title-a-z',
                'label' => 'Judul A-Z',
            ],
            [
                'value' => 'title-z-a',
                'label' => 'Judul Z-A',
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
     * Get all public posts
     * @return Paginator
     */
    public function getAll()
    {
        return (new PostRepo)->getPublicPosts((object) [
            'search' => $this->search,
            'category' => $this->category,
            'tag' => $this->tag,
            'sort' => $this->sort,
        ], $this->per_page);
    }

    /**
     * Get all post categories
     * @return Category
     */
    public function getPostCategories()
    {
        return Category::query()
            ->with('childs')
            ->active()
            ->select(['id', 'parent_id', 'name', 'slug'])
            ->whereNull('parent_id')
            ->where('group', 'posts')
            ->orderBy('sort_order')
            ->limit(10)
            ->get();
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
            'sort',
        );


        $this->dispatch('filter-reset', [
            'input[name="search"]' => $this->search,
            'select[name="category"]' => $this->category,
            'select[name="sort"]' => $this->sort,
        ]);
    }

    public function render()
    {
        return view('front::livewire.blog.listing', [
            'datas' => self::getAll(),
            'categories' => self::getPostCategories(),
            'sort_order' => self::sortOrder()
        ]);
    }
}
