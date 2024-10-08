<?php

namespace Modules\Front\Livewire\Certificate;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Modules\Common\Traits\Utils\FlashMessage;
use Modules\Course\Models\CustomerCourse;
use Modules\Front\Traits\Livewire\Ecommerce;

class Verify extends Component
{
    use Ecommerce, FlashMessage;

    /**
     * Define string props
     * @var ?string
     */
    public ?string $search = '';

    /**
     * Define props value before component rendered
     *
     * @param string $certificate_id
     * @return void
     */
    public function mount($certificate_id)
    {
        $this->search = $certificate_id;
    }

    /**
     * Find certificate with case sensitve query
     * @return CustomerCourse
     */
    public function findCertificate()
    {
        return CustomerCourse::with('customer:id,name,avatar', 'course')->where(
            DB::raw('BINARY `certificate_id`'), $this->search ?: '--NO-CERTIFICATE--'
        )->first();
    }

    /**
     * Hooks for apply filter
     * @return void
     */
    public function applyFilter()
    {
        // $this->resetPage();
    }

    public function render()
    {
        return view('front::livewire.certificate.verify', [
            'certificate' => self::findCertificate(),
        ]);
    }
}
