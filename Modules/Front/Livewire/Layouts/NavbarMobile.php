<?php

namespace Modules\Front\Livewire\Layouts;

use Livewire\Component;
use Modules\Common\Models\Category;

class NavbarMobile extends Component
{
    /**
     * Define bool property
     * @return bool
     */
    public bool $loggedIn = false;

    /**
     * Define array property
     * @return array
     */
    public array $menus = [];

    /**
     * Define props value before component rendered
     *
     * @param array $menu
     * @param bool $loggedIn
     * @return void
     */
    public function mount(array $menus = [], bool $loggedIn = false)
    {
        $this->menus = $menus;
        $this->loggedIn = $loggedIn;
    }

    public function render()
    {
        return view('front::livewire.layouts.navbar-mobile');
    }
}
