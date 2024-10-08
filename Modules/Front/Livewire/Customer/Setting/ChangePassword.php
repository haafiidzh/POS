<?php

namespace Modules\Front\Livewire\Customer\Setting;

use Exception;
use Illuminate\Validation\Rules\Password;
use Livewire\Component;
use Modules\Common\Traits\Utils\FlashMessage;
use Modules\Customer\Models\Customer;

class ChangePassword extends Component
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
    public ?string $password = '';
    public ?string $password_confirmation = '';

    /**
     * Set validation rules
     *
     * @var array
     */
    protected function rules()
    {
        return [
            'password' => [
                'required',
                Password::min(8)
                    ->mixedCase()
                    ->symbols()
                    ->uncompromised(),
                'confirmed',
            ],
            'password_confirmation' => 'nullable',
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

        } catch (Exception $exception) {
            return $this->dispatchError($exception->getMessage());
        }
    }

    /**
     * Update password
     *
     * @return void
     */
    public function update()
    {
        $this->validate();

        if ($this->password) {
            $data['password'] = bcrypt($this->password);
        }

        try {
            $this->customer->update($data);
            $this->reset('password', 'password_confirmation');

            return $this->dispatchSuccess('Kata sandi berhasil diperbarui.');
        } catch (Exception $exception) {
            return $this->dispatchError($exception->getMessage());
        }
    }

    public function render()
    {
        return view('front::livewire.customer.setting.change-password');
    }
}
