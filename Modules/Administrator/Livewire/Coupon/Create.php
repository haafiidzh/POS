<?php

namespace Modules\Administrator\Livewire\Coupon;

use Exception;
use Livewire\Component;
use Modules\Common\Contracts\WithModal;
use Modules\Common\Traits\Utils\FlashMessage;
use Modules\ECommerce\Models\Coupon;

class Create extends Component
{
    use WithModal, FlashMessage;

    /**
     * Define string props
     * @var string
     */
    public ?string $code = '';
    public ?string $description = '';
    public ?string $type = 'fixed';
    public ?string $expiry_date = '';

    /**
     * Define int props
     * @var int
     */
    public ?int $usage_limit_per_user = 0;
    public ?int $amount = 0;
    public ?int $max_discount = 0;
    public ?int $min_purchase = 1;
    public ?int $quota = 1;

    /**
     * Define bool props
     * @var bool
     */
    public ?bool $is_active = true;

    /**
     * Define livewire event listeners
     * @var array
     */
    protected $listeners = [
        self::INIT_MODAL,
        self::CLOSE_MODAL,
    ];

    /**
     * Set validation rules
     * @var array
     */
    protected function rules()
    {
        return [
            'code' => 'required|max:191|unique:coupons,code',
            'description' => 'nullable',
            'type' => 'required',
            'amount' => 'required|numeric|regex:/^[0-9]*$/',
            'expiry_date' => 'required',
            'usage_limit_per_user' => 'numeric|regex:/^[0-9]*$/',
            'quota' => 'numeric|regex:/^[0-9]*$/',
            'is_active' => 'nullable',
        ];
    }

    /**
     * Set validation messages
     * @var array
     */
    protected $messages = [
        '*.required' => ':attribute tidak boleh kosong',
        '*.unique' => ':attribute telah digunakan.',
        '*.numeric' => ':attribute hanya diperbolehkan angka.',
        '*.min' => 'form :attribute min. :min karakter',
        '*.max' => 'form :attribute maks. :max karakter',
        'name.regex' => ':attribute hanya diperbolehkan huruf.',
        'price.regex' => ':attribute hanya diperbolehkan angka.',
    ];

    /**
     * Set validation attributes
     * @var array
     */
    protected $validationAttributes = [
        'code' => 'Kode Kupon',
        'description' => 'Deskripsi',
        'type' => 'Tipe diskon',
        'amount' => 'Nilai Diskon',
        'expiry_date' => 'Tgl. Kadaluarsa',
        'usage_limit_per_user' => 'Batas Pengguna',
        'quota' => 'Kuota Kupon',
        'is_active' => 'Status',
    ];

    /**
     * Livewire hooks, when search props has been updated
     * This method will be running
     *
     * @param  string $value
     * @return void
     */
    public function updated($property, $value)
    {
        // $this->name = slug($value);
    }

    /**
     * Store coupon data to database
     *
     * @return void
     */
    public function store()
    {
        $this->validate();

        $data = [
            'code' => $this->code,
            'description' => $this->description,
            'type' => $this->type,
            'amount' => $this->amount,
            'max_discount' => $this->max_discount,
            'min_purchase' => $this->min_purchase,
            'expiry_date' => $this->expiry_date,
            'usage_limit_per_user' => $this->usage_limit_per_user,
            'quota' => $this->quota,
            'is_active' => $this->is_active,
            'created_by' => user('id'),
            'updated_by' => user('id'),
        ];

        try {
            Coupon::create($data);
            $this->reset();
            return $this->dispatchSuccess('Kupon berhasil ditambahkan.');
        } catch (Exception $exception) {
            $this->reset();
            return $this->dispatchError($exception->getMessage());
        }
    }

    public function render()
    {
        return view('administrator::livewire.coupon.create');
    }
}
