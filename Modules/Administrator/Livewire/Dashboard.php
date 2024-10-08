<?php

namespace Modules\Administrator\Livewire;

use Livewire\Component;
use Modules\Common\Contracts\WithThirdParty;
use Modules\Common\Traits\Utils\FlashMessage;

class Dashboard extends Component
{
    use WithThirdParty, FlashMessage;

    /**
     * Define array props
     * @var array
     */
    public $dates = [
        'start' => '',
        'end' => '',
    ];

    /**
     * Define event listeners
     * @var array
     */
    public $listeners = [
        self::UPDATED_DATERANGEPICKER,
    ];

    /**
     * Define props value before component rendered
     * @return void
     */
    public function mount()
    {
        $this->dates['start'] = now()->startOfYear()->toDateString();
        $this->dates['end'] = now()->endOfYear()->toDateString();
    }

    /**
     * Hooks for date range picker property
     * Doing date range picker validation after
     * Date property has been updated
     *
     * @param  array $value
     * @return void
     */
    public function updatedDaterangePicker(array $value)
    {
        $this->dates = $value;
    }

    public function render()
    {
        return view('administrator::livewire.dashboard');
    }
}
