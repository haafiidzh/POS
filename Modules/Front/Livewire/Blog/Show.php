<?php

namespace Modules\Front\Livewire\Blog;

use Livewire\Component;
use Modules\Common\Models\Post;
use Modules\Front\Traits\Livewire\Ecommerce;
use Modules\Common\Traits\Utils\FlashMessage;

class Show extends Component
{
    use FlashMessage, Ecommerce;

    /**
     * Define post props
     * @var Post $post
     */
    public Post $post;

    /**
     * Define strign props
     * @var ?string
     */
    public ?string  $post_id;

    /**
     * Define props value before component rendered
     * @return void
     */
    public function mount(Post $post)
    {
        $this->post = $post;
        $this->post_id = $post->id;
    }

    public function render()
    {
        return view('front::livewire.blog.show');
    }
}
