<div x-show="createModal" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog"
     aria-modal="true" wire:init="initModal">
    <div class="flex items-end justify-center min-h-screen px-4 text-center items-center sm:p-0">
        <div x-cloak x-show="createModal" x-transition:enter="transition ease-out duration-300 transform"
             x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0" class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-40"
             aria-hidden="true"></div>

        <div x-cloak x-show="createModal" x-transition:enter="transition ease-out duration-300 transform"
             x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave="transition ease-in duration-200 transform"
             x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             class="inline-block w-full max-w-xl my-20 overflow-hidden text-left transition-all transform bg-white rounded-lg shadow-xl 2xl:max-w-2xl">

            <div class="bg-light px-6 py-4 flex justify-between items-center {{ $loading ? 'skeleton' : null }}">
                <h5 class="modal-title">Tambah Kupon</h5>
                <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        x-on:click="createModal = false" wire:click="closeModal">
                    <i class="bx bx-x"></i>
                </button>
            </div>

            <form class="p-6" wire:submit.prevent="store" wire:loading.class="skeleton" wire:target="store">
                <div class="grid md:grid-cols-2">
                    {{-- Kode Kupon --}}
                    <div class="form-group">
                        <label for="code">Kode Kupon</label>
                        <input type="text" class="form-input" id="code" wire:model.defer="code"
                               placeholder="KUPONMERDEKA">
                        @error('code')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Tgl. Kadaluarsa --}}
                    <div class="form-group">
                        <label for="expiry_date">Tgl. Kadaluarsa</label>
                        <input type="date" class="form-input" id="expiry_date" wire:model.defer="expiry_date">
                        @error('expiry_date')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                {{-- Deskripsi --}}
                <div class="form-group">
                    <label for="description">Deskripsi</label>
                    <textarea type="text" class="form-input" id="description" wire:model.defer="description"></textarea>
                    @error('description')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="relative grid grid-cols-4" x-init="active = '{{ $type }}'" x-data="{
                    active: '',
                    tabs: [{
                            value: 'fixed',
                            label: 'Tetap'
                        },
                        {
                            value: 'percent',
                            label: 'Persentase'
                        }
                    ],
                    setType: function(value) {
                        this.active = value
                        this.$wire.set('type', value)
                    }
                }">

                    {{-- Tipe Diskon --}}
                    <div class="form-group col-span-2">
                        <label for="type">
                            Tipe Diskon
                        </label>
                        <ul class="grid grid-flow-col text-center text-gray-500 bg-gray-100 rounded-lg p-1">
                            <template x-for="(tab, index) in tabs" :key="index">
                                <li>
                                    <a href="javascript:void(0)"
                                       class="flex justify-center py-2 transition-all transition-transform"
                                       x-on:click="setType(tab.value)"
                                       x-bind:class="active == tab.value ? 'bg-white rounded-lg shadow text-indigo-900' : ''"
                                       x-text="tab.label"></a>
                                </li>
                            </template>
                        </ul>
                        @error('type')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>


                    <div class="form-group col-span-4">

                        <div class="grid md:grid-cols-2 gap-4 mb-4">
                            <div class="col-span-1">
                                <label for="amount">Nilai Diskon</label>
                                @if ($type == 'fixed')
                                    <x-common::utils.input-price :value="$amount" property="amount" />
                                @elseif($type == 'percent')
                                    <x-common::utils.input-number :value="$amount ?: 0" property="amount" suffix=" %" />
                                @endif

                                @error('amount')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-span-1">
                                <label for="quota">Kuota Kupon</label>
                                <div class="input-group append">
                                    <input type="number" class="form-input" id="quota" wire:model.defer="quota">
                                    <div class="text">Buah</div>
                                </div>
                                @error('quota')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="grid md:grid-cols-2 gap-4 mb-4">
                            <div class="col-span-1">
                                <label for="usage_limit_per_user">Batas Penggunaan</label>
                                <div class="input-group append">
                                    <input type="number" class="form-input" id="usage_limit_per_user"
                                           wire:model.lazy="usage_limit_per_user"
                                           title="Kupon hanya bisa digunakan {{ $usage_limit_per_user }} kali oleh setiap pengguna">
                                    <div class="text">Kali</div>
                                </div>
                                @error('usage_limit_per_user')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-span-1">
                                <label for="min_purchase">Min. Pembelian</label>
                                <x-common::utils.input-price :value="$min_purchase" property="min_purchase" />
                                @error('min_purchase')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        @if ($type == 'percent')
                            <div class="grid md:grid-cols-2 gap-4">
                                <div class="col-span-1">
                                    <label for="max_discount">Maks. Diskon</label>
                                    <x-common::utils.input-price :value="$max_discount" property="max_discount" />
                                    @error('max_discount')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                @can('publish.ecommerce_setting-coupon', 'web')
                    {{-- Status --}}
                    <div class="form-group">
                        <div class="flex items-center">
                            <input type="checkbox" class="form-switch" id="is_active" name="is_active"
                                   wire:click="$toggle('is_active')" {{ $is_active ? 'checked' : null }}>
                            <label class="text-gray-800 text-sm font-medium inline-block ms-2" for="is_active">
                                Aktifkan kupon?
                            </label>
                        </div>
                        @error('is_active')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                @endcan

                <div class="flex justify-end gap-2 mt-4 pt-4 border-t">
                    <button type="button" class="btn bg-gray-100 hover:bg-gray-200" x-on:click="createModal = false"
                            wire:click="closeModal">
                        Batal
                    </button>

                    {{-- Save Button --}}
                    <x-common::utils.button class="btn bg-dark text-white hover:bg-slate-900" :disabled="false"
                                            :loading="true" target="store">
                        Simpan
                    </x-common::utils.button>
                </div>
            </form>
        </div>
    </div>
</div>
