<?php

namespace Modules\Administrator\Livewire\Transaction;

use Exception;
use Livewire\Component;
use Modules\Administrator\Models\Transaction;

class Create extends Component
{
    /**
     * Define query string props
     *
     * @var string
     */
    public $name;
    public $email;
    public $address;
    public $state;
    public $price;
    public $check = true;
    public $toggle = true;

    /**
     * Set validation rules
     *
     * @var array
     */
    protected $rules = [
        'name' => 'required|max:191|regex:/^[a-zA-Z ]*$/',
        'email' => 'required|max:191|email',
        'address' => 'required|max:500',
        'price' => 'required|max:20|regex:/^[0-9]*$/',
        'check' => 'nullable',
        'toggle' => 'nullable',
    ];

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
        'name' => 'Nama',
        'email' => 'Email',
        'address' => 'Alamat',
        'price' => 'Harga',
        'check' => 'Checkbox',
        'toggle' => 'Toggle Checkbox',
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
     * Store transaction data to database
     *
     * @return void
     */
    public function store()
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'address' => $this->address,
            'state' => $this->state,
            'price' => $this->price,
            'check' => $this->check,
            'toggle' => $this->toggle,
        ];

        try {
            Transaction::create($data);
            $this->reset();

            return session()->flash('success', 'Transaction berhasil ditambahkan.');
        } catch (Exception $exception) {
            return session()->flash('error', $exception->getMessage());
        }
    }

    public function render()
    {
        return view('administrator::livewire.transaction.create');
    }
}
