<div x-data="{ showCouponModal: false }">
    <div class="mb-6">
        <div class="mx-auto text-center mb-10 lg:max-w-screen-md">
            <h2 class="text-dark my-4 text-3xl font-bold sm:text-3xl">{{ cache('coupon.title') }}</h2>
            <p class="text-base text-body-color mb-6">{{ cache('coupon.description') }}</p>

            <form wire:submit.prevent="applyFilter">
                <div class="flex">
                    <div class="input-group append w-full">
                        <input type="text" name="search" class="form-input text-base !py-3 px-4"
                               placeholder="Cari kupon disini..." wire:model.defer="search">

                        <x-front::utils.button class="text !bg-white hover:!bg-white" :loading="true"
                                               target="applyFilter">
                            <i class="bx bxearch"></i>
                        </x-front::utils.button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @forelse ($coupons as $coupon)
            <x-front::utils.coupon-card :coupon="$coupon" with-show-button />
        @empty
            <div class="col-span-1 md:col-span-2">
                <x-front::utils.404 class="ring-2 ring-gray-200">
                    Upsss... Kita tidak menemukan kupon yang kamu cari.
                    Coba gunakan keyword lainnya ya...
                </x-front::utils.404>
            </div>
        @endforelse
    </div>

    {{ $coupons->onEachSide(0)->links('livewire::front-tailwind') }}

    <livewire:front::coupon.show />
</div>
