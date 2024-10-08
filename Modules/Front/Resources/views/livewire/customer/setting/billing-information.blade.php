<div role="tabpanel" aria-labelledby="vertical-tab-with-border-item-1">
    <div class="card">
        <div class="card-header">
            <h5 class="text-slate-800">Informasi Tagihan</h5>
        </div>
        <hr class="mt-3">
        <div class="card-body">
            <form wire:submit.prevent="update" wire:key="{{ randAlpha() }}">
                <div class="grid grid-cols-2 gap-x-4">
                    <div class="form-group">
                        <label for="fullname">Nama Lengkap</label>
                        <input type="text" class="form-input" id="fullname" wire:model.defer="fullname">
                        @error('fullname')
                            <small class="text-red-500">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="date_of_birth">Tangal Lahir </label>
                        <input type="date" class="form-input" id="date_of_birth" wire:model.defer="date_of_birth">
                        @error('date_of_birth')
                            <small class="text-red-500">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label class="!mb-2">Jenis Kelamin</label>
                    <div class="flex flex-wrap gap-x-3 gap-y-2">
                        @foreach ($genders as $item)
                            <div class="flex items-center">
                                <input id="gender-{{ $loop->iteration }}" type="radio" value="{{ $item['value'] }}"
                                       name="gender" wire:model.live="gender"
                                       class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-1 dark:bg-gray-700 dark:border-gray-600">
                                <label for="gender-{{ $loop->iteration }}" class="!font-light ml-2">
                                    {{ $item['label'] }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                    @error('gender')
                        <small class="text-red-500">{{ $message }}</small>
                    @enderror
                </div>

                <div class="grid grid-cols-2 gap-x-4">
                    <div class="form-group col-span-1">
                        <label>No. Telpon</label>
                        <div class="input-group prepend w-full">
                            <span class="text left !bg-transparent !pl-4 !pr-0 !text-slate-700 !text-[14px]">+62</span>
                            <x-front::utils.input-phone class="pl-[.2rem]" property="phone_number" :value="$phone_number" />
                        </div>
                        @error('phone_number')
                            <small class="text-red-500">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group col-span-1">
                        <label>No. Whatsapp</label>
                        <div class="input-group prepend w-full">
                            <span class="text left !bg-transparent !pl-4 !pr-0 !text-slate-700 !text-[14px]">+62</span>
                            <x-front::utils.input-phone class="pl-[.2rem]" property="whatsapp_number"
                                                        :value="$whatsapp_number" />
                        </div>
                        @error('whatsapp_number')
                            <small class="text-red-500">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-x-4">
                    <div class="sm:col-span-3">
                        <label for="province_id">Alamat</label>
                    </div>
                    <div class="form-group col-span-1">
                        <select name="province_id" id="province_id" wire:model.live="province_id" class="form-input">
                            <option value="">Provinsi</option>
                            @foreach ($provinces as $province)
                                <option value="{{ $province->id }}">{{ $province->name }}</option>
                            @endforeach
                        </select>
                        @error('province_id')
                            <small class="text-red-500">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group col-span-1">
                        <select name="regency_id" id="regency_id" wire:model.live="regency_id" class="form-input">
                            <option value="">Kota/Kab.</option>
                            @foreach ($regencies as $regency)
                                <option value="{{ $regency->id }}">{{ $regency->name }}</option>
                            @endforeach
                        </select>
                        @error('regency_id')
                            <small class="text-red-500">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group col-span-1">
                        <select name="district_id" id="district_id" wire:model.live="district_id" class="form-input">
                            <option value="">Kecamatan</option>
                            @foreach ($districts as $district)
                                <option value="{{ $district->id }}">{{ $district->name }}</option>
                            @endforeach
                        </select>
                        @error('district_id')
                            <small class="text-red-500">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group sm:col-span-3">
                        <textarea name="address" id="address" class="form-input" wire:model.defer="address" placeholder="Jl. Kenanga No. A28"></textarea>
                        @error('address')
                            <small class="text-red-500">{{ $message }}</small>
                        @enderror
                    </div>

                </div>

                <div class="text-end">
                    {{-- Save Button --}}
                    <x-common::utils.button class="btn primary text-sm" :disabled="false" :loading="true"
                                            target="update">
                        Simpan
                    </x-common::utils.button>
                </div>
            </form>
        </div>
    </div>
</div>
