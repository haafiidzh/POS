<?php

namespace Modules\Administrator\Livewire\Partner;

use Exception;
use Livewire\Component;
use Modules\Common\Contracts\WithThirdParty;
use Modules\Common\Models\Category;
use Modules\Common\Models\Partner;
use Modules\Core\Models\User;
use Modules\Common\Models\Province;
use Modules\Common\Models\District;
use Modules\Common\Models\Village;
use Modules\Common\Models\Regency;
use Modules\Common\Traits\Utils\FlashMessage;

class Create extends Component
{
    use WithThirdParty, FlashMessage;

    // Define string props
    public ?string $user_id = null;
    public ?string $address = null;
    public ?string $maps_link = null;
    public ?string $status = null;
    public ?string $phone = null;
    public ?string $name = null;


    // Define int props
    public ?int $selectedProvince = null;
    public ?int $selectedDistrict = null;
    public ?int $selectedRegency = null;
    public ?int $selectedVillage = null;
    public ?int $identify_number = null;


    
    public ?int $provinces_id = null;
    public ?int $districts_id = null;
    public ?int $regencies_id = null;
    public ?int $villages_id = null;


    public $provinces = [], $regencies = [], $districts = [], $villages = [], $users = [];
    public ?bool $publish = true;

    protected function rules()
    {
        return [
            'address' => 'required',
            'name' => 'required',
            'user_id' => 'required',
            'phone' => 'required|numeric|unique:partners,phone',
            'identify_number' => 'required|numeric|unique:partners,identify_number',
            'maps_link' => 'nullable|url',
        ];
    }

    public function mount()
    {
        $this->provinces = Province::all();
        $this->users =User::role('Mitra')->get();
    }

    public function loadRegenciesByProvince($provinceId)
    {
        $this->regencies = Regency::where('province_id', $provinceId)->get();
        $this->districts = [];
        $this->villages = [];
        $this->selectedRegency = null;
        $this->selectedDistrict = null;
        $this->selectedVillage = null;
    }

    public function loadDistrictsByRegency($regencyId)
    {
        $this->districts = District::where('regency_id', $regencyId)->get();
        $this->villages = [];
        $this->selectedDistrict = null;
        $this->selectedVillage = null;
    }

    public function loadVillagesByDistrict($districtId)
    {
        $this->villages = Village::where('district_id', $districtId)->get();
        $this->selectedVillage = null;
    }

    public function getAdminUsers()
    {
        return User::role('Mitra')->get();
    }

    public function store()
    {
        $this->validate();

        try {
            $data = [
                'user_id' => $this->user_id,
                'address' => $this->address,
                'phone' => $this->phone,
                'provinces_id' => $this->selectedProvince,
                'districts_id' => $this->selectedDistrict,
                'regencies_id' => $this->selectedRegency,
                'villages_id' => $this->selectedVillage,
                'identify_number' => $this->identify_number,
                'maps_link' => $this->maps_link,
                'name' => $this->name,

            ];

            $data['status'] = $this->publish ? "active" : "hold";

            Partner::create($data);

            $this->reset(
                'user_id',
                'address',
                'name',
                'phone',
                'status',
                'selectedProvince',
                'selectedDistrict',
                'selectedRegency',
                'selectedVillage',
                'identify_number',
                'maps_link'
            );

            $this->resetThirdParty();

            return $this->dispatchSuccess('Partner berhasil ditambahkan.');
        } catch (Exception $exception) {
            return $this->dispatchError($exception->getMessage());
        }
    }

    public function render()
    {
        return view('administrator::livewire.partner.create', [
            'provinces' => $this->provinces,
            'districts' => $this->districts,
            'regencies' => $this->regencies,
            'villages' => $this->villages,
            'users' => $this->getAdminUsers(),
        ]);
    }
}
