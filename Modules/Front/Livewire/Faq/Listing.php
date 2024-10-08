<?php

namespace Modules\Front\Livewire\Faq;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\Common\Models\Faq;

class Listing extends Component
{
    use WithPagination;

    /**
     * Define string property
     * @var string
     */
    public string $search = '';

    /**
     * Define int property
     * @var int
     */
    public int $per_page = 10;

    /**
     * Get all faqs
     * @return Faq
     */
    public function getAll()
    {
        return Faq::active()
            ->when($this->search, function ($query) {
                return $query->search((object)[
                    'search' => $this->search
                ]);
            })
            ->orderBy('created_at', 'desc')
            ->paginate($this->per_page);
    }

    /**
     * Hooks for apply filter
     * @return void
     */
    public function applyFilter()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('front::livewire.faq.listing', [
            'datas' => self::getAll()
        ]);
    }
}
