<?php

namespace Modules\Front\Livewire\Customer\Notification;

use Livewire\Component;
use Modules\Customer\Models\CustomerNotification;
use Modules\Customer\Services\Repositories\CustomerNotificationRepo;

class Listing extends Component
{
    /**
     * Define string property
     * @var string
     */
    public $menu = 'all';
    public $search = '';

    /**
     * Define itn property
     * @var int
     */
    public $per_page = 10;

    /**
     * Define livewire event listener
     * Livewire hooks
     *
     * @var array
     */
    protected $listeners = [
        'updateMenu'
    ];

    /**
     * Set property value before component rendered
     *
     * @param  string $menu
     * @return void
     */
    public function mount($menu = 'all')
    {
        $this->menu = $menu;
    }

    /**
     * Update menu callback
     *
     * @param  string $menu
     * @return void
     */
    public function updateMenu($menu)
    {
        $this->menu  = $menu;
        $this->reset('search', 'per_page');
    }

    /**
     * Load more order data
     * @return void
     */
    public function loadMore()
    {
        $this->per_page += 10;
    }

    /**
     * Set notification as seen
     *
     * @param  int $notification_id
     * @return void
     */
    public function setSeen($notification_id)
    {
        $notification =  CustomerNotification::find($notification_id);
        $notification->seen_at = now();
        $notification->save();

        return redirect()->to($notification->link);
    }

    /**
     * Get all order from resource
     * @return void
     */
    public function getAll()
    {
        return (new CustomerNotificationRepo)->filters((object) [
            'search' => $this->search,
            'tab' => $this->menu,
            'sort' => 'created_at',
            'order' => 'desc',
        ], $this->per_page);
    }

    public function render()
    {
        return view('front::livewire.customer.notification.listing', [
            'items' => self::getAll()
        ]);
    }
}
