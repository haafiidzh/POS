<div x-show="showCouponModal" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog"
     aria-modal="true" wire:init="initModal">
    <div class="flex items-end justify-center min-h-screen px-4 text-center items-center sm:p-0">
        <div x-cloak x-show="showCouponModal" x-transition:enter="transition ease-out duration-300 transform"
             x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0" class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-40"
             aria-hidden="true"></div>

        <div x-cloak x-show="showCouponModal" x-transition:enter="transition ease-out duration-300 transform"
             x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave="transition ease-in duration-200 transform"
             x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             class="inline-block w-full max-w-xl my-20 overflow-hidden text-left transition-all transform bg-slate-100 rounded-lg shadow-xl 2xl:max-w-2xl">

            <div class="relative overflow-hidden text-center">
                <div class="flex justify-between w-full pt-4 px-4 mb-2">
                    <h5 class="text-slate-600">Detail Kupon</h5>
                    <button type="button" x-on:click="showCouponModal = false" wire:click="closeModal"
                            class="inline-flex flex-shrink-0 justify-center items-center size-6 rounded-lg text-gray-500 hover:text-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 transition-all text-sm">
                        <i class="bx bx-x"></i>
                    </button>
                </div>
            </div>
            <div class="card-body {{ $loading ? 'skeleton' : null }} p-4">
                @if ($coupon)
                    <x-front::utils.coupon-card :coupon="$coupon" />

                    <div class="my-3">
                        <h3 class="text-xl text-slate-700">Keterangan.</h3>
                        <div class="text-sm text-slate-500">
                            {!! $coupon->description !!}
                        </div>
                    </div>
                @else
                    <x-front::coupon-detail-placeholder />
                @endif
            </div>
        </div>
    </div>
</div>
