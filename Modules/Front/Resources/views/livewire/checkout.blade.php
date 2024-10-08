<div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
    <div class="col-span-1 lg:col-span-8">
        @if (count($items) > 0)
            <section class="mb-10">
                <div class="max-w-xl mb-6">
                    <h2 class="text-xl text-slate-700 mb-2">{{ cache('checkout.billing.title') }}</h2>
                    <p class="text-slate-400 text-sm">{{ cache('checkout.billing.description') }}</p>
                </div>

                <div class="card bg-white mb-3">
                    <div class="card-body sm:!p-10">
                        <div class="grid grid-cols-1 sm:grid-cols-2 sm:gap-2">
                            <div class="form-group">
                                <label>Nama Lengkap</label>
                                <div class="col-span-1 form-input">{{ optional($customer)->name }}</div>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <div class="col-span-1 form-input">{{ optional($customer)->email }}</div>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 sm:gap-2">
                            <div class="form-group" x-data="{ edit_mode: false }" wire:loading.class="skeleton"
                                 wire:target="updatePhoneNumber" x-on:click.outside="edit_mode = false">
                                <label>No. Telpon</label>
                                <div class="col-span-1 form-input" x-on:click="edit_mode = !edit_mode"
                                     x-show="!edit_mode">
                                    {{ $phone_number ? phone($phone_number, 'ID', 'INTERNATIONAL') : '-' }}
                                </div>
                                <div class="col-span-1" x-show="edit_mode" style="display: none">
                                    <div class="input-group both w-full">
                                        <span
                                              class="text left !bg-transparent !pl-4 !pr-0 !text-slate-700 !text-[14px]">+62</span>
                                        <x-front::utils.input-phone class="pl-[.2rem]" property="phone_number"
                                                                    :value="$phone_number ?: 0" />
                                        <div class="text right cursor-pointer" wire:click="updatePhoneNumber"
                                             x-on:click="edit_mode = !edit_mode">
                                            <i class="bx bx-check"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group" x-data="{ edit_mode: false }" wire:loading.class="skeleton"
                                 wire:target="updateWhatsappNumber" x-on:click.outside="edit_mode = false">
                                <label>No. Whatsapp</label>
                                <div class="col-span-1 form-input" x-on:click="edit_mode = !edit_mode"
                                     x-show="!edit_mode">
                                    {{ $whatsapp_number ? phone($whatsapp_number, 'ID', 'INTERNATIONAL') : '-' }}
                                </div>
                                <div class="col-span-1" x-show="edit_mode" style="display: none">
                                    <div class="input-group both w-full">
                                        <span
                                              class="text left !bg-transparent !pl-4 !pr-0 !text-slate-700 !text-[14px]">+62</span>
                                        <x-front::utils.input-phone class="pl-[.2rem]" property="whatsapp_number"
                                                                    :value="$whatsapp_number ?: 0" />
                                        <div class="text right cursor-pointer" wire:click="updateWhatsappNumber"
                                             x-on:click="edit_mode = !edit_mode">
                                            <i class="bx bx-check"></i>
                                        </div>
                                    </div>
                                    <small class="text-xs font-light text-slate-400 hover:text-slate-600 italic">
                                        <a href="javascript:void(0)" wire:click="makeSameAsPhone"
                                           x-on:click="edit_mode = !edit_mode">Samakan dengan no. telpon
                                            saya</a>
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="mb-5">
                <div class="max-w-xl mb-6">
                    <h2 class="text-xl text-slate-700 mb-2">{{ cache('checkout.order.title') }}</h2>
                    <p class="text-slate-400 text-sm">{{ cache('checkout.order.description') }}</p>
                </div>

                <div class="card bg-white mb-3">
                    <div class="card-body">
                        @foreach ($items as $item)
                            <div class="grid grid-cols-1 gap-2 rounded bg-white p-4 lg:px-6 lg:py-4"
                                 wire:loading.class="skeleton" wire:target="choosen_cart">
                                <x-front::course.order-preview :item="$item" />
                            </div>
                            @if (!$loop->last)
                                <hr class="my-2">
                            @endif
                        @endforeach
                    </div>
                </div>
            </section>
        @else
            <div class="mb-6 rounded bg-white px-6 py-14 text-center">
                <img class="w-[200px] m-auto mb-8" src="{{ cache('image_empty_cart') }}" alt="Empty Cart">
                <p class="font-normal w-[75%] max-w-[400px] m-auto">
                    Upss... kamu belum memilih kelas yang kamu inginkan.
                </p>
            </div>
        @endif

    </div>

    <div class="col-span-1 lg:col-span-4">
        <div class="card bg-white rounded sticky top-44 mb-5">
            <div class="card-body">
                <form wire:submit.prevent="checkCoupon" wire:loading.class="skeleton" wire:target="checkCoupon">
                    <div class="form-group">
                        <label for="coupon_code">Kode Kupon</label>
                        <div class="input-group append">
                            <input type="text" class="form-input placeholder:text-slate-300" id="coupon_code"
                                   wire:model.defer="coupon_code" placeholder="KODEKUPON">
                            <button class="text right cursor-pointer">
                                <i class="bx bx-check"></i>
                            </button>
                        </div>
                    </div>
                </form>
                <div class="flex flex-col gap-2 text-sm">
                    <div class="flex justify-between">
                        <p class="text-slate-700 font-medium">Subtotal</p>
                        <p class="text-slate-500">{{ price($calculate->total_price, true) }}</p>
                    </div>
                    <div class="flex justify-between">
                        <p class="text-slate-700 font-medium">Potongan</p>
                        <p class="text-red-500">{{ price(round($calculate->total_discount), true) }}</p>
                    </div>
                    @if ($calculate->total_coupon_discount)
                        <div class="flex justify-between">
                            <p class="text-slate-700 font-medium">Kupon</p>
                            <p class="text-red-500">{{ price(round($calculate->total_coupon_discount), true) }}</p>
                        </div>
                    @endif
                </div>
                <hr class="my-4" />
                <div class="flex flex-col gap-2 text-sm mb-4">
                    <div class="flex justify-between">
                        <p class="text-slate-700 font-medium">Total</p>
                        <p class="text-slate-500">{{ price($calculate->sub_total_payment, true) }}</p>
                    </div>
                    @if ($calculate->with_tax)
                        <div class="flex justify-between">
                            <p class="text-slate-700 font-medium">PPN({{ cache('ecommerce_tax_rate') }})</p>
                            <p class="text-slate-500">{{ price(round($calculate->total_tax), true) }}</p>
                        </div>
                    @endif
                    @if ($calculate->with_fee)
                        <div class="flex justify-between">
                            <p class="text-slate-700 font-medium">Biaya Admin</p>
                            <p class="text-slate-500">{{ price(round($calculate->fee_rate), true) }}</p>
                        </div>
                    @endif
                    <div class="flex justify-between">
                        <p class="text-lg font-bold">Total Pembayaran</p>
                        <div class="">
                            <p class="mb-1 text-lg font-bold">
                                {{ price($calculate->total_payment, true) }}
                            </p>
                        </div>
                    </div>
                </div>

                <hr class="my-4" />

                <div class="flex items-center text-sm {{ count($items) > 0 ? 'mb-4' : '' }}">
                    <input id="default-checkbox" type="checkbox" wire:model.live="terms_conditions"
                           class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                    <label for="default-checkbox" class="ms-2 text-sm text-gray-900">
                        Saya menyetujui <a href="{{ route('front.terms-conditions') }}" target="_blank"
                           class="text-blue-400 hover:text-blue-600">
                            Syarat & Ketentuan</a>
                    </label>

                </div>

                @if (count($items) > 0)
                    <x-front::utils.button class="btn primary text-sm block" :loading="true" target="payNow"
                                           wire:click="payNow">
                        Beli Sekarang
                    </x-front::utils.button>
                @endif

                <p class="text-xs text-center mt-4">
                    Payment Gateway by <a href="https://www.xendit.co/en-id/" class="font-medium hover:text-primary"
                       target="_blank">Xendit</span>
                </p>
            </div>
        </div>

    </div>
</div>
