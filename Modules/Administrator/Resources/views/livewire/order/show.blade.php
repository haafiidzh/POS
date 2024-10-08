<div x-show="showOrderModal" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog"
     aria-modal="true" wire:init="initModal">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div x-cloak x-show="showOrderModal" x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
             x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0" class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75"
             aria-hidden="true"></div>

        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        <div x-cloak x-show="showOrderModal" x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             class="inline-block w-full max-w-xl p-6 my-8 overflow-hidden text-left align-middle transition-all transform bg-white shadow-xl rounded-2xl sm:my-16 sm:align-middle sm:max-w-2xl">

            <div class="mt-2">
                @if ($order)
                    <div class="mb-5 pb-5 flex justify-between items-center border-b border-gray-200">
                        <div>
                            <h2 class="text-2xl font-semibold text-gray-800">Invoice</h2>
                        </div>

                        <div class="inline-flex gap-x-2">
                            <a class="btn outline-light" href="javascript:void(0)">
                                <i class="bx bx-download mr-2"></i> PDF
                            </a>
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-3">
                        <div>
                            <div class="grid space-y-3">
                                <dl class="flex flex-col sm:flex-row gap-x-3 text-sm">
                                    <dt class="min-w-36 max-w-[200px] text-gray-500">
                                        Invoice number:
                                    </dt>
                                    <dd class="font-medium text-gray-800">
                                        #{{ $order->order_code }} - {{ $order->payment_status }}
                                    </dd>
                                </dl>

                                <dl class="flex flex-col sm:flex-row gap-x-3 text-sm">
                                    <dt class="min-w-36 max-w-[200px] text-gray-500">
                                        Order Status:
                                    </dt>
                                    <dd class="font-medium text-gray-800">
                                        {{ $order->order_status }}
                                    </dd>
                                </dl>

                                <dl class="flex flex-col sm:flex-row gap-x-3 text-sm">
                                    <dt class="min-w-36 max-w-[200px] text-gray-500">
                                        Billed to:
                                    </dt>
                                    <dd class="text-gray-800">
                                        <a class="inline-flex items-center gap-x-1.5 text-blue-600 decoration-2 hover:underline focus:outline-none focus:underline font-medium"
                                           href="mailto:{{ $order->billing_email }}">
                                            {{ $order->billing_email }}
                                        </a>
                                    </dd>
                                </dl>

                                <dl class="flex flex-col sm:flex-row gap-x-3 text-sm">
                                    <dt class="min-w-36 max-w-[200px] text-gray-500">
                                        Billing details:
                                    </dt>
                                    <dd class="font-medium text-gray-800">
                                        <span class="block font-semibold">{{ $order->billing_full_name }}</span>
                                        <address class="not-italic font-normal">
                                            {{ $order->billing_full_address }}
                                        </address>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 border border-gray-200 p-2 rounded-lg grid gap-2">
                        @foreach ($order->details as $detail)
                            <div class="flex">
                                <div class="flex-shrink-0 mr-4">
                                    <img src="{{ $detail->image_path ? url($detail->image_path) : cache('thumbnail_square') }}"
                                         alt="Gambar {{ $detail->product_name }}"
                                         class="w-24 aspect-video object-cover rounded-lg">
                                </div>
                                <div class="flex-grow">
                                    <h5
                                        class="text-lg font-medium max-w-sm text-dark leading-6 line-clamp-2 text-ellipsis">
                                        {{ $detail->product_name }}</h5>

                                    <div class="flex justify-between items-center">
                                        <span>{{ $detail->qty }}x</span>
                                        <div class="text-right ml-4">
                                            @if ($detail->product_discount_price)
                                                <p class="text-xs text-gray-500 line-through">
                                                    {{ price($detail->product_price, true) }}
                                                </p>
                                            @endif
                                            <p class="font-semibold">
                                                {{ price($detail->getRawPrice(), true) }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-8 flex sm:justify-end">
                        <div class="w-full max-w-2xl sm:text-end space-y-2">
                            <div class="grid grid-cols-2 sm:grid-cols-1 gap-3 sm:gap-2">
                                <dl class="grid sm:grid-cols-5 gap-x-3 text-sm">
                                    <dt class="col-span-3 text-gray-500">Subotal:</dt>
                                    <dd class="col-span-2 font-medium text-gray-800">
                                        {{ price($order->order_nominal, true) }}
                                    </dd>
                                </dl>

                                @if ($order->order_discount_nominal)
                                    <dl class="grid sm:grid-cols-5 gap-x-3 text-sm">
                                        <dt class="col-span-3 text-gray-500">Discount:</dt>
                                        <dd class="col-span-2 font-medium text-red-600">
                                            {{ price($order->order_discount_nominal, true) }}
                                        </dd>
                                    </dl>
                                @endif

                                @if ($order->coupon_rate)
                                    <dl class="grid sm:grid-cols-5 gap-x-3 text-sm">
                                        <dt class="col-span-3 text-gray-500">Coupon:</dt>
                                        <dd class="col-span-2 font-medium text-red-600">
                                            {{ price($order->coupon_rate, true) }}
                                        </dd>
                                    </dl>
                                @endif

                                @if ($order->tax_nominal)
                                    <dl class="grid sm:grid-cols-5 gap-x-3 text-sm">
                                        <dt class="col-span-3 text-gray-500">{{ $order->tax_title }}
                                            ({{ $order->tax_rate }}%):</dt>
                                        <dd class="col-span-2 font-medium text-gray-800">
                                            {{ price($order->tax_nominal, true) }}</dd>
                                    </dl>
                                @endif

                                @if ($order->fee_rate)
                                    <dl class="grid sm:grid-cols-5 gap-x-3 text-sm">
                                        <dt class="col-span-3 text-gray-500">{{ $order->fee_title }}:</dt>
                                        <dd class="col-span-2 font-medium text-gray-800">
                                            {{ price($order->fee_rate, true) }}</dd>
                                    </dl>
                                @endif

                                <dl class="grid sm:grid-cols-5 gap-x-3 text-sm">
                                    <dt class="col-span-3 text-gray-500">Total:</dt>
                                    <dd class="col-span-2 font-medium text-gray-800">
                                        {{ price($order->order_paid_nominal, true) }}</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="flex justify-center items-center h-64">
                        <div class="animate-spin rounded-full h-16 w-16 border-t-2 border-b-2 border-primary-600">
                        </div>
                    </div>
                @endif
            </div>

            <div class="mt-4 pt-4 text-right border-t">
                <button type="button" class="btn dark" wire:click="cleanUp" x-on:click="showOrderModal = false">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>
