<?php

namespace Modules\Front\Livewire\Faq;

use Livewire\Component;
use Illuminate\Pagination\Paginator;
use Modules\Common\Services\Repositories\FaqRepo;

class Featured extends Component
{
    /**
     * Get all featured faq
     * @return Paginator
     */
    public function getAll()
    {
        return (new FaqRepo)->getPublicFaqs((object) [
            'sort' => 'sort_order',
            'order' => 'asc'
        ], 5);
    }

    public function render()
    {
        return view('front::livewire.faq.featured', [
            'datas' => self::getAll()
        ]);
    }
}
