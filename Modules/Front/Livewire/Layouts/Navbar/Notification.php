<?php

namespace Modules\Front\Livewire\Layouts\Navbar;

use Livewire\Component;
use Modules\Customer\Models\CustomerNotification;

class Notification extends Component
{
    /**
     * Get all notifications
     * @return CustomerNotification
     */
    public function getAll()
    {
        return CustomerNotification::with('category:id,icon')->orderBy('created_at', 'desc')->limit(10)->get();
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

    public function render()
    {
        return view('front::livewire.layouts.navbar.notification', [
            'notifications' => $notifications = self::getAll(),
            'count' => $notifications->whereNull('seen_at')->count()
        ]);
    }
}
