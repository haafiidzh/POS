<?php

namespace Modules\Front\Livewire\Blog\Widget;

use Livewire\Component;
use Modules\Common\Services\Repositories\PostRepo;

class Popular extends Component
{
    public ?int $per_page = 3;

    public function getAll()
    {
        return (new PostRepo)->getPopularPosts($this->per_page);
    }

    public function render()
    {
        return view('front::livewire.blog.widget.popular', [
            'populars' => self::getAll()
        ]);
    }
}
