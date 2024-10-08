<div>
    <form wire:submit.prevent="update">
        <div class="flex flex-col md:flex-row gap-6">
            <div class="md:w-8/12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0 pb-1">Informasi Partner </h5>
                    </div>

                    <div class="card-body">
                        <!-- Province Dropdown -->
                        <div class="form-group">
                            <label for="province">Provinsi</label>
                            <select class="form-input" name="province" id="province" wire:model="selectedProvince">
                                <option value="">Pilih Provinsi</option>
                                @foreach ($provinces as $province)
                                    <option value="{{ $province->id }}">{{ $province->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- District Dropdown -->
                        <div class="form-group mt-4">
                            <label for="regency">Kabupaten/Kota</label>
                            <select class="form-input" name="regency" id="regency" wire:model="selectedRegency">
                                <option value="">Pilih Kabupaten/Kota</option>
                                @foreach ($regencies as $regency)
                                <option value="{{ $regency->id }}">{{ $regency->name }}</option>
                            @endforeach
                               
                            </select>
                        </div>

                        <!-- Regency Dropdown -->
                        <div class="form-group mt-4">
                            <label for="district">Kecamatan</label>
                            <select class="form-input" name="district" id="district" wire:model="selectedDistrict">
                                <option value="">Pilih Kecamatan</option>
                                @foreach ($districts as $district)
                                <option value="{{ $district->id }}">{{ $district->name }}</option>
                            @endforeach
                            </select>
                        </div>

                        <!-- Village Dropdown -->
                        <div class="form-group mt-4">
                            <label for="village">Desa/Kelurahan</label>
                            <select class="form-input" name="village" id="village" wire:model="selectedVillage">
                                <option value="">Pilih Desa/Kelurahan</option>
                                @foreach ($villages as $village)
                                    <option value="{{ $village->id }}">{{ $village->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Village Dropdown -->
                        <div class="form-group mt-4">
                            <label for="user">Pengguna</label>
                            <select class="form-input" name="user_id" id="user" wire:model="user_id">
                                <option value="">Pilih Pengguna</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>


                        <!-- Address Input -->
                        <div class="form-group mt-4">
                            <label for="address">Alamat</label>
                            <input id="address" type="text" class="form-input" name="address" wire:model="address">
                            @error('address')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                         <!-- Address Input -->
                         <div class="form-group mt-4">
                            <label for="name">Nama</label>
                            <input id="name" type="text" class="form-input" name="name" wire:model="name">
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Phone Input -->
                        <div class="form-group mt-4">
                            <label for="phone">Telepon</label>
                            <input id="phone" type="text" class="form-input" name="phone" wire:model="phone">
                            @error('phone')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Identify Number Input -->
                        <div class="form-group mt-4">
                            <label for="identify_number">Nomor Identifikasi</label>
                            <input id="identify_number" type="text" class="form-input" name="identify_number"
                                wire:model="identify_number">
                            @error('identify_number')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Maps Link Input -->
                        <div class="form-group mt-4">
                            <label for="maps_link">Link Peta</label>
                            <input id="maps_link" type="text" class="form-input" name="maps_link"
                                wire:model="maps_link">
                            @error('maps_link')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Publish Checkbox -->
                        @can('publish.article', 'web')
                            <div class="form-group mt-4">
                                <label for="publish">
                                    <input type="checkbox" class="form-checkbox rounded text-primary" id="publish"
                                        name="publish" wire:model="publish">
                                    Publish Partner?
                                </label>
                                @error('publish')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        @endcan

                        <div class="px-2 mt-4">
                            <!-- Save Button -->
                            <x-common::utils.button class="btn bg-dark text-white hover:bg-slate-900" :disabled="false"
                                :loading="true" target="store">
                                Simpan
                            </x-common::utils.button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Page loaded with data: ', @json($users));
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const provinceSelect = document.getElementById('province');
            const regencySelect = document.getElementById('regency');
            const districtSelect = document.getElementById('district');
            const villageSelect = document.getElementById('village');

            // Event listener for province selection
            provinceSelect.addEventListener('change', function() {
                const provinceId = this.value;
                @this.call('loadRegenciesByProvince',
                provinceId); // Call the method to load regencies based on province
            });

            // Event listener for regency selection
            regencySelect.addEventListener('change', function() {
                const regencyId = this.value;
                @this.call('loadDistrictsByRegency', regencyId); // Load districts based on selected regency
            });

            // Event listener for district selection
            districtSelect.addEventListener('change', function() {
                const districtId = this.value;
                @this.call('loadVillagesByDistrict',
                districtId); // Load villages based on selected district
            });
        });
    </script>
@endpush
