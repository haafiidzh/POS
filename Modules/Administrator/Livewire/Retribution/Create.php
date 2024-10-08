<?php

namespace Modules\Administrator\Livewire\Retribution;


use Exception;
use Illuminate\Support\Str;
use Livewire\Component;
use Modules\Common\Contracts\WithThirdParty;
use Modules\Common\Models\Category;
use Modules\Common\Models\Retribution;
use Modules\Common\Traits\Utils\FlashMessage;

class Create extends Component
{
    use WithThirdParty, FlashMessage;

    /**
     * Define string props
     * @var string
     */
    public ?int $nominal = null;

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

    /**
     * Store post to database
     * @return void
     */
    public function store()
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


            Retribution::create($data);

            // Reset props
            $this->reset(
                'nominal',
                'number_of_days',
                'category',
            );

            // Reset third party
            $this->resetThirdParty();

            return $this->dispatchSuccess('Retribusi berhasil ditambahkan.');
        } catch (Exception $exception) {
            return $this->dispatchError($exception->getMessage());

        }
    }

    public function render()
    {
        return view('administrator::livewire.retribution.create', [
            'categories' => self::getCategories(),
        ]);
    }
}
