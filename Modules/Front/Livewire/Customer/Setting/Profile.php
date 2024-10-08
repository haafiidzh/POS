<?php

namespace Modules\Front\Livewire\Customer\Setting;

use Exception;
use Livewire\Component;
use Livewire\WithFileUploads;
use Modules\Common\Contracts\WithThirdParty;
use Modules\Common\Services\ImageService;
use Modules\Common\Traits\Utils\FlashMessage;
use Modules\Customer\Models\Customer;

class Profile extends Component
{
    use WithThirdParty, FlashMessage, WithFileUploads;

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
    public ?string $name = '';
    public ?string $avatar = '';
    public ?string $oldAvatar = '';
    public ?string $email = '';

    /**
     * Define event listeners
     * @var array
     */
    protected $listeners = [
        self::UPDATED_CROPPER,
    ];

    /**
     * Set validation rules
     *
     * @var array
     */
    protected function rules()
    {
        return [
            'name' => 'required|max:191|regex:/^[a-zA-Z ]*$/',
            'email' => 'required|max:191|email|unique:customers,email,' . $this->customer_id,
        ];
    }

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
                throw new Exception('Customer tidak ditemukan, pengaturan gagal di-edit.');
            }

            $this->customer = $customer;
            $this->customer_id = $customer->id;
            $this->name = $customer->name;
            $this->oldAvatar = $customer->getAvatar();
            $this->email = $customer->email;

        } catch (Exception $exception) {
            return $this->dispatchError($exception->getMessage());
        }

    }

    /**
     * Livewire hook for updated avatar cropper events
     *
     * @param  string $value
     * @return void
     */
    public function updatedCropper($value)
    {
        $this->avatar = $value;
    }

    /**
     * Update profile data
     *
     * @return void
     */
    public function update()
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'email' => $this->email,
        ];

        try {
            if ($this->avatar) {
                $data['avatar'] = (new ImageService)->storeImageFromBase64($this->avatar, 400);
            }

            $this->customer->update($data);

            if ($this->avatar) {
                $this->dispatch('updated-avatar', [
                    'url' => $data['avatar'],
                ]);
                $this->customer = auth('customer')->user();
                $this->oldAvatar = auth('customer')->user()->avatar;
            }

            return $this->dispatchSuccess('Profil berhasil diperbarui.');
        } catch (Exception $exception) {
            return $this->dispatchError($exception->getMessage());
        }
    }

    public function render()
    {
        return view('front::livewire.customer.setting.profile');
    }
}
