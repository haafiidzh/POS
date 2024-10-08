<div class="grid grid-cols-1 gap-4" x-data="{ showOrderModal: false }">
    <div class="input-group append col-span-1">
        <input type="text" class="form-input border-0 py-3 placeholder:text-slate-300" wire:model.lazy="search"
               placeholder="Cari berdasarkan No. Tagihan, Nama Produk, atau Deskripsi Produk">
        <div class="text !bg-white !border-0"><i class="bx bxearch"></i></div>
    </div>

    @forelse ($items as $order)
        <div class="grid grid-cols-1 rounded bg-white overflow-hidden" wire:loading.class="skeleton">
            <div class="cursor-pointer" x-on:click="showOrderModal = !showOrderModal"
                 wire:click="showOrder('{{ $order->id }}')">
                {{-- Card Header --}}
                <div class="border-b pt-4 pb-3 px-4 flex justify-between">
                    <div class="inline-flex">
                        <p class="text-slate-800 text-sm">
                            #{{ $order->order_code }}
                        </p>
                    </div>
                    <div class="inline-flex text-xs text-slate-500 items-center gap-1">
                        {!! $order->orderStatusBadge() !!} | {{ dateTimeTranslated($order->created_at) }}
                    </div>
                </div>

                {{-- Card Body --}}
                @foreach ($order->details->take(1) as $detail)
                    <div class="col-span-1 flex flex-row w-full p-3">
                        <div class="flex mb-3 mr-2">
                            <div>
                                <div class="aspect-[4/3] border border-light rounded overflow-hidden w-16 sm:w-28">
                                    <img class="w-full h-full object-cover object-center"
                                         src="{{ $detail->getThumbnail() }}" alt="product-image" />
                                </div>
                            </div>
                        </div>
                        <div class="ms-2 w-full pt-2">
                            <div class="grid grid-cols-6">
                                <div class="col-span-4">
                                    <p class="text-xs text-slate-600 m-auto">
                                        {{ $detail->product_name }}
                                    </p>
                                </div>
                                <div class="col-span-2 text-end">
                                    <p class="text-black text-sm sm:text-base">
                                        {{ price($detail->product_discount_price, true) }}</p>
                                </div>
                            </div>
                            <div class="grid grid-cols-6">
                                <div class="col-span-2">
                                    <p class="text-xs text-slate-500">
                                        {{ $detail->qty }} x
                                    </p>
                                </div>
                                <div class="col-span-4">
                                    <div class="col-span-2 text-end text-xs">
                                        @if ($detail->product_discount_price)
                                            <p class="text-danger/50 mb-1">
                                                <del class="text-[10px]">
                                                    {{ price($detail->product_price, true) }}
                                                </del>
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Card Footer --}}
            <div class="py-6 px-4 bg-blue-100/70 grid grid-cols-6">
                <div class="col-span-3">
                    @if ($order->isPending())
                        <a href="{{ $order->payment_link }}" class="btn primary text-xs px-3">
                            Bayar Tagihan
                        </a>
                    @endif
                </div>
                <div class="col-span-3 text-end text-slate-500 self-center">
                    <p class="flex items-center justify-end">
                        <span class="text-black/70 text-xs mr-2">
                            Total Tagihan:
                        </span>
                        <span class="text-black text-base">
                            {{ price($order->order_paid_nominal, true) }}
                        </span>
                    </p>
                </div>
            </div>
        </div>
    @empty
        <x-front::utils.404>
            Upsss... Sepertinya kamu belum memiliki pesanan. Silahkan pesan kelas yang kamu inginkan.
        </x-front::utils.404>
    @endforelse

    @if ($items->hasMorePages())
        <div class="mb-5 col-span-1">
            <x-front::utils.button class="btn primary text-sm block" :loading="true" target="loadMore"
                                   wire:click="loadMore">
                Lebih banyak
            </x-front::utils.button>
        </div>
    @endif

    <livewire:front::customer.order.show />
</div>
