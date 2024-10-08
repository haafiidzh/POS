<?php

namespace Modules\Administrator\Livewire\Retribution;

use App\Livewire\Component\Editor;
use Exception;
use Livewire\Component;
use Modules\Common\Contracts\WithThirdParty;
use Modules\Common\Models\Category;
use Modules\Common\Models\Retribution;
use Modules\Common\Traits\Utils\FlashMessage;
use Modules\Core\Http\Livewire\Component\Filepond\Image;

class Edit extends Component
{
    use WithThirdParty, FlashMessage;

    /**
     * Define retribution props
     * @var Retribution $retribution
     */
    public Retribution $retribution;



    public ?int $nominal = null;
    public ?int $retribution_id = null;


    /**
     * Define int props
     * @var int
     */
    public ?int $category = null;
    public ?int $number_of_days = null;


    /**
     * Define bool props
     * @var bool
     */
    public ?bool $publish = true;

    /**
     * Define event listeners
     * @var array
     */

    /**
     * Define validation rules
     * @return void
     */
    protected function rules()
    {
        return [
            'category' => 'required',
            'nominal' => 'required',
            'number_of_days' => 'required',
        ];
    }



    public function getCategories()
    {
        return Category::where('group', 'like', '%retribution%')->whereNull('parent_id')->get();
    }


    public function mount(Retribution $retribution)
    {
        $this->retribution = $retribution;
        $this->retribution_id = $retribution->id;
        $this->category = $retribution->category_id;
        $this->number_of_days = $retribution->number_of_days;
        $this->nominal = $retribution->nominal;

        if ($retribution->is_active == 0 ) {
            $this->publish = false;
        } else if ($retribution->is_active != 0 ) {
            $this->publish = true;
        } 
    }



    public function update()
    {
        // Validation
        $this->validate();

        try {
            $data = [
                'nominal' => $this->nominal,
                'number_of_days' => $this->number_of_days,
                'category_id' => $this->category,
                'created_by' => user('id'),
            ];

            // publish
            if ($this->publish) {
                $data['is_active'] = 1;
            } else {
                $data['is_active'] = 0;
            }
            $this->retribution->update($data);

            return $this->dispatchSuccess('Produk berhasil diperbarui.');
        } catch (Exception $exception) {
            return $this->dispatchError($exception->getMessage());
        }
    }

    public function render()
    {
        return view('administrator::livewire.retribution.edit', [
            'categories' => self::getCategories(),
        ]);
    }
}
