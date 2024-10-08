<div x-data="{ showOrderModal: false }">

    {{-- Statistic Widgets --}}
    <div class="grid grid-cols-1 gap-4 mb-4 md:grid-cols-3">
        <div class="card">
            <div class="p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0 me-3">
                        <div class="flex items-center justify-center w-12 h-12 rounded bg-primary/25 text-primary">
                            <i class="text-xl bx bx-line-chart"></i>
                        </div>
                    </div>
                    <div class="flex-grow">
                        <h5 class="mb-1">Total Debet</h5>
                        <p class="text-slate-500">{{ price($count->debit, true) }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0 me-3">
                        <div class="flex items-center justify-center w-12 h-12 rounded bg-warning/25 text-warning">
                            <i class="text-xl bx bx-line-chart-down"></i>
                        </div>
                    </div>
                    <div class="flex-grow">
                        <h5 class="mb-1">Total Credit</h5>
                        <p class="text-slate-500">{{ price($count->credit, true) }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0 me-3">
                        <div class="flex items-center justify-center w-12 h-12 rounded bg-dark/25 text-dark">
                            <i class="text-xl bx bx-dollar"></i>
                        </div>
                    </div>
                    <div class="flex-grow">
                        <h5 class="mb-1">Balance</h5>
                        <p class="text-slate-500">{{ price($count->debit - $count->credit, true) }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Filter --}}
    <div class="p-6 card">
        <div class="flex flex-col gap-2 mb-4 md:flex-row">
            <div class="flex flex-wrap gap-2">

                {{-- Filter Dropdown --}}
                <div class="relative w-fit" x-data="{
                    openMain: false,
                    openSubmenu: '',
                    handleOpen: function(menu) {
                        this.openSubmenu = menu;
                    },
                    handleClose: function() {
                        this.openMain = false;
                        this.openSubmenu = '';
                    },
                }">
                    <button class="w-full text-sm btn light md:block" x-on:click="openMain = !openMain">
                        Filter
                        <i class="ml-1 bx bxs-chevron-down"></i>
                    </button>

                    <div class="absolute z-10 mt-2 bg-white divide-y divide-gray-100 rounded-lg shadow -left-10 w-44 md:left-0"
                         style="display: none" x-show="openMain" x-on:click.outside="handleClose"
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 transform scale-95"
                         x-transition:leave="transition ease-in duration-200"
                         x-transition:leave-end="opacity-0 transform scale-95">
                        <ul class="p-2 text-xs text-gray-700">
                            <li class="relative">
                                <button class="flex items-center justify-between w-full px-4 py-2 rounded hover:bg-gray-100"
                                        x-on:click="handleOpen('type')">
                                    <span class="overflow-hidden text-ellipsis whitespace-nowrap">Jenis Transaksi</span>
                                    <i class="bx bx-right-arrow-alt"></i>
                                </button>

                                <div class="absolute top-0 z-10 ml-3 bg-white divide-y divide-gray-100 rounded-lg shadow left-full w-44"
                                     style="display: none" x-show="openSubmenu == 'type'"
                                     x-transition:enter="transition ease-out duration-300"
                                     x-transition:enter-start="opacity-0 transform scale-95"
                                     x-transition:leave="transition ease-in duration-200"
                                     x-transition:leave-end="opacity-0 transform scale-95">
                                    <ul class="p-2 text-xs text-gray-700">
                                        <li>
                                            <div class="{{ $transaction_type == 'all' ? 'bg-gray-200' : '' }} flex cursor-pointer items-center gap-2 rounded px-4 py-2 hover:bg-gray-100"
                                                 x-on:click="handleClose; $wire.set('transaction_type', 'all')">
                                                Semua
                                            </div>
                                        </li>
                                        @foreach ($types as $item)
                                            <li>
                                                <div class="{{ $transaction_type == $item->value ? 'bg-gray-200' : '' }} flex cursor-pointer items-center gap-2 rounded px-4 py-2 hover:bg-gray-100"
                                                     x-on:click="handleClose; $wire.set('transaction_type', '{{ $item }}')">
                                                    <span
                                                          class="overflow-hidden text-ellipsis whitespace-nowrap">{{ $item->label() }}</span>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </li>
                            <li class="relative">
                                <button class="flex items-center justify-between w-full px-4 py-2 rounded hover:bg-gray-100"
                                        x-on:click="handleOpen('payment_type')">
                                    <span class="overflow-hidden text-ellipsis whitespace-nowrap">Metode
                                        Pembayaran</span>
                                    <i class="bx bx-right-arrow-alt"></i>
                                </button>

                                <div class="absolute top-0 z-10 ml-3 bg-white divide-y divide-gray-100 rounded-lg shadow left-full w-44"
                                     style="display: none" x-show="openSubmenu == 'payment_type'"
                                     x-transition:enter="transition ease-out duration-300"
                                     x-transition:enter-start="opacity-0 transform scale-95"
                                     x-transition:leave="transition ease-in duration-200"
                                     x-transition:leave-end="opacity-0 transform scale-95">
                                    <ul class="p-2 text-xs text-gray-700">
                                        <li>
                                            <div class="{{ $payment_type == 'all' ? 'bg-gray-200' : '' }} flex cursor-pointer items-center gap-2 rounded px-4 py-2 hover:bg-gray-100"
                                                 x-on:click="handleClose; $wire.set('payment_type', 'all')">
                                                Semua
                                            </div>
                                        </li>
                                        @foreach ($payment_types as $item)
                                            <li>
                                                <div class="{{ $payment_type == $item->value ? 'bg-gray-200' : '' }} flex cursor-pointer items-center gap-2 rounded px-4 py-2 hover:bg-gray-100"
                                                     x-on:click="handleClose; $wire.set('payment_type', '{{ $item }}')">
                                                    <span
                                                          class="overflow-hidden text-ellipsis whitespace-nowrap">{{ $item->label() }}</span>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                {{-- Export Dropdown --}}
                <div class="relative w-fit" x-data="{
                    openMain: false,
                    handleOpen: function() {
                        this.openMain = !this.openMain;
                    },
                    handleClose: function() {
                        this.openMain = false;
                    },
                }">
                    <button class="w-full text-sm btn light md:block" x-on:click="handleOpen">
                        Export
                        <i class="ml-1 bx bxs-chevron-down"></i>
                    </button>

                    <div class="absolute z-10 mt-2 bg-white divide-y divide-gray-100 rounded-lg shadow -left-10 w-44 md:left-0"
                         style="display: none" x-show="openMain" x-on:click.outside="handleClose"
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 transform scale-95"
                         x-transition:leave="transition ease-in duration-200"
                         x-transition:leave-end="opacity-0 transform scale-95">
                        <ul class="p-2 text-xs text-gray-700">
                            <li>
                                <div class="flex items-center gap-2 px-4 py-2 rounded cursor-pointer hover:bg-gray-100"
                                     x-on:click="handleClose">
                                    CSV
                                </div>
                            </li>
                            <li>
                                <div class="flex items-center gap-2 px-4 py-2 rounded cursor-pointer hover:bg-gray-100"
                                     x-on:click="handleClose">
                                    Excel
                                </div>
                            </li>
                            <li>
                                <div class="flex items-center gap-2 px-4 py-2 rounded cursor-pointer hover:bg-gray-100"
                                     x-on:click="handleClose">
                                    PDF
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            {{-- Date range picker --}}
            <livewire:common::utils.daterange-picker class="w-full md:w-1/3 lg:w-1/4" :value="$dates" />

            {{-- Search --}}
            <div class="w-full input-group md:w-1/3 lg:w-1/4">
                <div class="relative w-full h-fit">
                    <label class="sr-only" for="search">Search</label>
                    <input class="form-input pl-11" name="search" type="text" wire:model.lazy="search"
                           placeholder="Pencarian...">
                    <div class="absolute inset-y-0 flex items-center pl-4 pointer-events-none start-0">
                        <i class="bx bx-search"></i>
                    </div>
                </div>
            </div>
        </div>

        <x-common::table.table :custom-table="$table" :datas="$datas" :sort="$sort" :order="$order" without-card>

            @forelse ($datas as $item)
                <tr wire:key="item-{{ $item->id }}">
                    <x-common::table.td>
                        <div class="flex items-center">
                            <div class="flex-shrink-0 w-10 h-10 mr-2">
                                <img class="w-10 h-10 rounded-full"
                                     src="{{ optional($item->customer)->getAvatar() }}"
                                     alt="{{ optional($item->customer)->name }}">
                            </div>
                            <div>
                                {{ optional($item->customer)->name }}
                            </div>
                        </div>
                    </x-common::table.td>
                    <x-common::table.td>
                        #{{ $item->order_code }}
                    </x-common::table.td>
                    <x-common::table.td class="text-center">
                        {{ $item->type }}
                    </x-common::table.td>
                    <x-common::table.td class="text-center">
                        {!! $item->statusBadge() !!}
                    </x-common::table.td>
                    <x-common::table.td class="text-sm whitespace-nowrap">
                        {{ $item->payment_date }}
                    </x-common::table.td>
                    <x-common::table.td class="text-center">
                        {{ $item->payment_method_type }}
                    </x-common::table.td>
                    <x-common::table.td class="text-end">
                        {{ $item->debit ? price($item->debit, true) : '-' }}
                    </x-common::table.td>
                    <x-common::table.td class="text-red-500 text-end">
                        {{ $item->credit ? price($item->credit, true) : '-' }}
                    </x-common::table.td>
                    <x-common::table.td>
                        <button class="text-xs btn outline-primary" wire:loading.class="opacity-50 cursor-not-allowed"
                                x-on:click="showOrderModal = !showOrderModal"
                                wire:click="showOrder('{{ $item->order_code }}')">
                            <i class="mr-2 bx bx-show"></i> Rincian
                        </button>
                    </x-common::table.td>
                </tr>
            @empty
                <tr>
                    <td colspan="{{ count($table->columns) }}">
                        <p class="p-4 text-center">
                            Tidak ada pesanan yang ditemukan sesuai kriteria pencarian Anda.
                        </p>
                    </td>
                </tr>
            @endforelse
        </x-common::table.table>
    </div>
    <livewire:administrator::order.show />
</div>
