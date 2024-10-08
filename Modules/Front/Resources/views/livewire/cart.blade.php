<div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
    <div class="col-span-1 lg:col-span-8">
        @forelse ($cart_items as $item)
            <div class="grid grid-cols-1 gap-2 mb-3 rounded bg-white p-4 lg:px-6 lg:py-4" wire:loading.class="skeleton"
                 wire:target="choosen_cart">
                <div class="col-span-1 flex flex-col sm:flex-row">
                    <div class="flex mb-3 sm:me-2 w-full">
                        <div class="flex mt-1 mr-3">
                            <input id="choosen_cart-{{ $item->id }}" type="checkbox" value="{{ $item->id }}"
                                   name="choosen_cart" wire:model.live="choosen_cart"
                                   class="w-5 h-5 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        </div>
                        <x-front::course.order-preview :item="$item" />
                    </div>
                </div>
            </div>
        @empty
            <div class="mb-6 rounded bg-white px-6 py-14 text-center">
                <img class="w-[200px] m-auto mb-8" src="{{ cache('image_empty_cart') }}" alt="Empty Cart">
                <p class="font-normal w-[75%] max-w-[400px] m-auto">
                    Upss... Keranjang kamu kosong. kamu belum memilih kelas yang kamu inginkan.
                </p>
            </div>
        @endforelse
    </div>

    <div class="col-span-1 lg:col-span-4">
        <div class="card bg-white rounded sticky top-44 mb-5">
            <div class="card-body">
                <div class="flex flex-col gap-2 text-sm">
                    <div class="flex justify-between">
                        <p class="text-slate-700 font-medium">Subtotal</p>
                        <p class="text-slate-500">{{ price($calculate->total_price, true) }}</p>
                    </div>
                    <div class="flex justify-between">
                        <p class="text-slate-700 font-medium">Potongan</p>
                        <p class="text-red-500">{{ price(round($calculate->total_discount), true) }}</p>
                    </div>
                </div>
                <hr class="my-4" />
                <div class="flex flex-col gap-2 text-sm {{ count($choosen_cart) > 0 ? 'mb-4' : '' }}">
                    <div class="flex justify-between">
                        <p class="text-lg font-bold">Total</p>
                        <div class="">
                            <p class="mb-1 text-lg font-bold">
                                {{ price($calculate->total_payment, true) }}
                            </p>
                        </div>
                    </div>
                </div>

                @if (count($choosen_cart) > 0)
                    <hr class="my-4" />
                    <x-front::utils.button class="btn primary text-sm block" :loading="true"
                                           target="processToCheckoutFromCart" wire:click="processToCheckoutFromCart">
                        Checkout Sekarang
                    </x-front::utils.button>
                @endif
            </div>
        </div>

    </div>
</div>
