<?php

namespace Modules\Administrator\Livewire\Coupon;

use Exception;
use Livewire\Component;
use Modules\ECommerce\Models\Coupon;
use Modules\Common\Contracts\WithModal;
use Modules\Common\Traits\Utils\FlashMessage;

class Edit extends Component
{
    use WithModal, FlashMessage;

    /**
     * Define coupon props
     * @var Coupon $coupon
     */
    public Coupon $coupon;

    /**
     * Define string props
     * @var string
     */
    public ?string $coupon_id = '';
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
        'editCoupon',
        self::INIT_MODAL,
        self::CLOSE_MODAL,
    ];


    /**
     * Set validation rules
     *
     * @var array
     */
    protected function rules()
    {
        return [
            'code' => 'required|max:191|unique:coupons,code,' . $this->coupon_id,
            'description' => 'nullable',
            'amount' => 'required|numeric|regex:/^[0-9]*$/',
            'expiry_date' => 'required',
            'usage_limit_per_user' => 'required|numeric|regex:/^[0-9]*$/',
            'quota' => 'required|numeric|regex:/^[0-9]*$/',
            'is_active' => 'nullable',
        ];
    }

    /**
     * Set validation messages
     *
     * @var array
     */
    protected $messages = [
        '*.required' => ':attribute tidak boleh kosong',
        '*.email' => 'format :email tidak sesuai',
        '*.min' => 'form :attribute min. :min karakter',
        '*.max' => 'form :attribute maks. :max karakter',
        'name.regex' => 'format :attribute tidak diperbolehkan. :attribute hanya diperbolehkan huruf.',
        'price.regex' => 'format :attribute tidak diperbolehkan. :attribute hanya diperbolehkan angka.',
    ];

    /**
     * Set validation attributes name
     *
     * @var array
     */
    protected $validationAttributes = [
        'code' => 'Kode',
        'description' => 'Deskripsi',
        'amount' => 'Jumlah',
        'expiry_date' => 'Tgl. Kadaluarsa',
        'usage_limit_per_user' => 'Batas per Pengguna',
        'quota' => 'Batas per Kupon',
        'is_active' => 'Status',
    ];

    /**
     * Define props value before component rendered
     *
     * @return void
     */
    public function mount()
    {
        //
    }


    /**
     * Livewire hook for edit coupon event
     *
     * @param  int|null $id
     * @return void
     */
    public function editCoupon($id)
    {

        try {
            $coupon = Coupon::find($id);

            if (!$coupon) {
                throw new Exception('Kupon tidak ditemukan, kategori gagal dimuat.');
            }

            $this->coupon_id = $coupon->id;
            $this->code = $coupon->code;
            $this->description = $coupon->description;
            $this->type = $coupon->type;
            $this->amount = $coupon->amount;
            $this->max_discount = $coupon->max_discount;
            $this->min_purchase = $coupon->min_purchase;
            $this->expiry_date = $coupon->expiry_date;
            $this->usage_limit_per_user = $coupon->usage_limit_per_user;
            $this->quota = $coupon->quota;
            $this->is_active = $coupon->is_active;
            $this->loading = false;
        } catch (Exception $exception) {
            $this->loading = false;
            return $this->dispatchError($exception->getMessage());
        }
    }

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
     * Update coupon data to database
     *
     * @return void
     */
    public function update()
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
            'updated_by' => user('id'),
        ];

        try {
            $coupon = Coupon::find($this->coupon_id);
            $coupon->update($data);

            return $this->dispatchSuccess('Kupon berhasil diperbarui.');
        } catch (Exception $exception) {
            $this->reset();
            return $this->dispatchError($exception->getMessage());
        }
    }

    public function render()
    {
        return view('administrator::livewire.coupon.edit');
    }
}
