<?php

namespace Modules\Front\Livewire\Customer\Setting;

use Exception;
use Livewire\Component;
use Modules\Common\Constants\Utilities;
use Modules\Common\Models\District;
use Modules\Common\Models\Province;
use Modules\Common\Models\Regency;
use Modules\Common\Traits\Utils\FlashMessage;
use Modules\Customer\Models\Customer;
use Modules\Customer\Services\Repositories\CustomerRepo;

class BillingInformation extends Component
{
    use FlashMessage;

    /**
     * Define customer props
     * @var Customer $customer
     */
    public Customer $customer;

    /**
     * Define string props
     * @var string
     */
    public ?string $customer_id = '';
    public ?string $fullname = '';
    public ?string $date_of_birth = null;
    public ?string $about = '';
    public ?string $province_id = '';
    public ?string $regency_id = '';
    public ?string $district_id = '';
    public ?string $address = '';
    public ?string $postal_code = '';
    public ?string $gender = '';
    public ?string $phone_code = 'id';
    public ?string $whatsapp_code = 'id';
    public ?string $phone_number = '';
    public ?string $whatsapp_number = '';

    /**
     * Define validation rules
     * @var array
     */
    public function rules()
    {
        return [
            'fullname' => 'nullable|regex:/^[a-zA-Z ]*$/|max:50',
            'date_of_birth' => 'nullable|date|before:' . now()->subYears(10)->toDateString(),
            'about' => 'nullable|max:150',
            'province_id' => 'nullable|size:2',
            'regency_id' => 'nullable|size:4',
            'district_id' => 'nullable|size:6',
            'address' => 'nullable|max:50',
            'postal_code' => 'nullable',
            'gender' => 'nullable|in:Pria,Wanita',
            'phone_number' => 'nullable|regex:/^[0-9]*$/|max:15',
            'whatsapp_number' => 'nullable|regex:/^[0-9]*$/|max:15',
        ];
    }

    /**
     * Define validation messages
     * @var array
     */
    protected $messages = [
        '*.required' => ':attribute tidak boleh kosong.',
        '*.email' => ':attribute tidak valid',
        'fullname.regex' => ':attribute hanya diperebolehkan huruf.',
        'whatsapp_number.regex' => ':attribute hanya diperebolehkan angka.',
        '*.max' => ':attribute maks. :max karakter.',
        '*.min' => ':attribute min. :min karakter.',
        '*.in' => ':attribute hanya diperbolehkan :values.',
        '*.before' => ':attribute hanya diperbolehkan sebelum :date.',
    ];

    /**
     * Define validation attribute aliases
     * @var array
     */
    protected $validationAttributes = [
        'fullname' => 'nama lengkap',
        'date_of_birth' => 'tgl. lahir',
        'about' => 'bio',
        'province_id' => 'provinsi',
        'regency_id' => 'kota/kab.',
        'district_id' => 'kecamatan',
        'address' => 'alamat',
        'postal_code' => 'kode pos',
        'gender' => 'jenis kelamin',
        'phone_number' => 'no. telpon',
        'whatsapp_number' => 'no. whatsapp',
    ];

    /**
     * Define props value before component rendered
     *
     * @param  Customer $customer
     * @return void
     */
    public function mount(?Customer $customer)
    {
        try {
            if (!$customer) {
                throw new Exception('Customer tidak ditemukan, pengaturan gagal dimuat.');
            }

            $this->customer = $customer;
            $this->customer_id = $customer->id;

            self::setPropsValue();
        } catch (Exception $exception) {
            return $this->dispatchError($exception->getMessage());
        }
    }

    /**
     * Livewire hooks for updated property
     *
     * @param  string $property
     * @param  string $value
     * @return void
     */
    public function updated($property, $value)
    {
        if ($property == 'province_id') {
            $this->reset('regency_id', 'district_id');
        }
        if ($property == 'regency_id') {
            $this->reset('district_id');
        }
    }

    /**
     * Set properties value
     * @return void
     */
    public function setPropsValue()
    {
        $setting = (new CustomerRepo)->validateSetting($this->customer);

        $this->fullname = $setting->fullname;
        $this->date_of_birth = $setting->date_of_birth;
        $this->about = $setting->about;
        $this->province_id = $setting->province_id;
        $this->regency_id = $setting->regency_id;
        $this->district_id = $setting->district_id;
        $this->address = $setting->address;
        $this->postal_code = $setting->postal_code;
        $this->gender = $setting->gender ?: null;
        $this->phone_number = $setting->phone_number;
        $this->whatsapp_number = $setting->whatsapp_number;
    }

    /**
     * Get all provinces
     * @return Province
     */
    public function getAllProvinces()
    {
        return Province::orderBy('name')->get();
    }

    /**
     * Get all regencies
     * @return Regency
     */
    public function getAllRegencies()
    {
        return Regency::where('province_id', $this->province_id)->orderBy('name')->get();
    }

    /**
     * Get all districts
     * @return District
     */
    public function getAllDistricts()
    {
        return District::where('regency_id', $this->regency_id)->orderBy('name')->get();
    }

    /**
     * Update billing information
     * @return void
     */
    public function update()
    {
        $this->validate();

        $data = [
            'fullname' => $this->fullname,
            'date_of_birth' => $this->date_of_birth,
            'about' => $this->about,
            'province_id' => $this->province_id,
            'regency_id' => $this->regency_id,
            'district_id' => $this->district_id,
            'address' => $this->address,
            'postal_code' => $this->postal_code,
            'gender' => $this->gender ?: null,
            'phone_number' => $this->phone_number,
            'whatsapp_number' => $this->whatsapp_number,
        ];

        try {
            $this->customer->setting()->update($data);
            self::setPropsValue();

            return $this->dispatchSuccess('Informasi tagihan berhasil diperbarui.');
        } catch (Exception $exception) {
            return $this->dispatchError($exception->getMessage());
        }
    }

    public function render()
    {
        return view('front::livewire.customer.setting.billing-information', [
            'provinces' => self::getAllProvinces(),
            'regencies' => self::getAllRegencies(),
            'districts' => self::getAllDistricts(),
            'genders' => Utilities::GENDER,
        ]);
    }
}
