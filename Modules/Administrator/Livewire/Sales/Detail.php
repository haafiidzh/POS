<?php

namespace Modules\Administrator\Livewire\Sales;

use Livewire\Component;

class Detail extends Component
{
    public $id_transaction;

    public function mount($transaction)
    {
        $this->id_transaction = $transaction;
    }
    
    public function render()
    {
        $datas = $this->id_transaction;
        return view('administrator::livewire.sales.detail', [
                'datas' => $datas,
            ]);
    }
}
