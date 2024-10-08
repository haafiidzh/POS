<div x-show="showOrderModal" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog"
     aria-modal="true" wire:init="initModal">
    <div class="flex items-end justify-center min-h-screen px-4 text-center items-center sm:p-0">
        <div x-cloak x-show="showOrderModal" x-transition:enter="transition ease-out duration-300 transform"
             x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0" class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-40"
             aria-hidden="true"></div>

        <div x-cloak x-show="showOrderModal" x-transition:enter="transition ease-out duration-300 transform"
             x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave="transition ease-in duration-200 transform"
             x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             class="inline-block w-full max-w-xl my-20 overflow-hidden text-left transition-all transform bg-white rounded-lg shadow-xl 2xl:max-w-2xl">

            <div class="relative overflow-hidden min-h-32 bg-gray-900 text-center">
                <div class="absolute top-2 end-2">
                    <button type="button" x-on:click="showOrderModal = false" wire:click="closeModal"
                            class="inline-flex flex-shrink-0 justify-center items-center size-8 rounded-lg text-gray-500 hover:text-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 focus:ring-offset-gray-900 transition-all text-sm dark:focus:ring-gray-700 dark:focus:ring-offset-gray-800">
                        <i class="bx bx-x"></i>
                    </button>
                </div>

                <figure class="absolute inset-x-0 bottom-0 -mb-px">
                    <svg preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                         viewBox="0 0 1920 100.1">
                        <path fill="currentColor" class="fill-white dark:fill-gray-800"
                              d="M0,0c0,0,934.4,93.4,1920,0v100.1H0L0,0z"></path>
                    </svg>
                </figure>
            </div>
            <div class="card-body {{ $loading ? 'skeleton' : null }}">

                @if ($order)
                    <div class="relative z-10 -mt-12">
                        <span
                              class="mx-auto flex justify-center items-center size-[62px] rounded-full border border-gray-200 bg-white text-gray-700 shadow-sm dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400">
                            <i class="bx bx-file text-3xl"></i>
                        </span>
                    </div>

                    <div class="p-4 sm:p-7 overflow-y-auto">
                        <div class="text-center">
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">
                                {{ cache('app_name') }}
                            </h3>
                            <p class="text-sm text-gray-500">
                                Invoice #{{ $order->order_code }}
                            </p>
                        </div>

                        <div class="mt-5 sm:mt-10 grid grid-cols-2 sm:grid-cols-3 gap-5">
                            <div>
                                <span class="block text-xs uppercase text-gray-500">Amount paid:</span>
                                <span class="block text-sm font-medium text-gray-800 dark:text-gray-200">
                                    {{ price($order->order_paid_nominal, true, 2) }}
                                </span>
                            </div>

                            <div>
                                <span class="block text-xs uppercase text-gray-500">Date Created:</span>
                                <span class="block text-sm font-medium text-gray-800 dark:text-gray-200">
                                    {{ dateTimeTranslated($order->created_at) }}
                                </span>
                            </div>

                            <div>
                                <span class="block text-xs uppercase text-gray-500">Payment method:</span>
                                <div class="flex items-center gap-x-2">
                                    <span class="block text-sm font-medium text-gray-800 dark:text-gray-200">
                                        {{ $order->payment_method }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="mt-5 sm:mt-10">
                            <h4 class="text-xs font-semibold uppercase text-gray-800 dark:text-gray-200">Rincian</h4>

                            <ul class="mt-3 flex flex-col">
                                @foreach ($order->details as $detail)
                                    <li
                                        class="inline-flex items-center gap-x-2 p-2 text-sm border text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg">
                                        <div class="flex items-center justify-between w-full">
                                            <a class="hover:text-gray-600" href="{{ $detail->product_link }}"
                                               target="_blank">
                                                <p>{{ $detail->product_name }}</p>
                                                <span class="text-xs text-slate-400">x{{ $detail->qty }}</span>
                                            </a>
                                            <span class="text-sm text-black">
                                                {{ price($detail->product_price, true, 2) }}</span>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>

                            <div class="grid grid-cols-3">
                                <div class="col-span-1"></div>
                                <ul class="mt-3 flex flex-col col-span-2">
                                    <li
                                        class="inline-flex items-center gap-x-2 p-2 text-sm text-gray-500 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg">
                                        <div class="flex items-center justify-between w-full">
                                            <span>Discount</span>
                                            <span
                                                  class="text-sm text-red-400">{{ price($order->order_discount_nominal, true, 2) }}</span>
                                        </div>
                                    </li>
                                    <li
                                        class="inline-flex items-center gap-x-2 p-2 text-sm text-gray-500 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg">
                                        <div class="flex items-center justify-between w-full">
                                            <span>Sub Total</span>
                                            <span
                                                  class="text-sm">{{ price($order->order_nominal + $order->order_discount_nominal, true, 2) }}</span>
                                        </div>
                                    </li>
                                    <li
                                        class="inline-flex items-center gap-x-2 p-2 text-sm text-gray-500 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg">
                                        <div class="flex items-center justify-between w-full">
                                            <span>{{ $order->tax_title }} ({{ $order->tax_rate }}%)</span>
                                            <span class="text-sm">{{ price($order->tax_nominal, true, 2) }}</span>
                                        </div>
                                    </li>
                                    <li
                                        class="inline-flex items-center gap-x-2 p-2 text-sm text-gray-500 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg">
                                        <div class="flex items-center justify-between w-full">
                                            <span>{{ $order->fee_title }}</span>
                                            <span class="text-sm">{{ price($order->fee_rate, true, 2) }}</span>
                                        </div>
                                    </li>
                                    <li
                                        class="inline-flex items-center gap-x-2 p-2 text-sm font-semibold text-black -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg dark:bg-slate-800">
                                        <div class="flex items-center justify-between w-full">
                                            <span>Total</span>
                                            <span>{{ price($order->order_paid_nominal, true, 2) }}</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="mt-5 sm:mt-10">
                            <p class="text-xs italic text-gray-500 max-w-2xl leading-4">
                                *If you have any questions, please contact us at
                                <a class="inline-flex items-center gap-x-1.5 text-blue-600 decoration-2 hover:underline"
                                   href="mailto:{{ cache('contact_email') }}">{{ cache('contact_email') }}</a> or chat
                                <a class="inline-flex items-center gap-x-1.5 text-blue-600 decoration-2 hover:underline"
                                   href="{{ phone(cache('contact_phone'), 'ID', 'RFC3966') }}">
                                    {{ phone(cache('contact_phone'), 'ID', 'INTERNATIONAL') }}
                                </a>
                            </p>
                        </div>
                    </div>
                @else
                    <x-front::order-detail-placeholder />
                @endif
            </div>
        </div>
    </div>
</div>
