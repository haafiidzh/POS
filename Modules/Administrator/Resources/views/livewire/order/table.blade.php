<div x-data="{ showOrderModal: false }">
    <div class="p-6">
        <div class="card mb-6 xl:max-w-[calc(100vw-300px)]">
            <div class="px-4 md:px-6">
                <nav class="flex space-x-3 border-b overflow-x-auto overflow-y-hidden" aria-label="Tabs">
                    @foreach ($order_statuses as $tab)
                        <button type="button" wire:click="$set('status', '{{ $tab['value'] }}')"
                                class="p-4 text-sm font-medium hover:text-primary hover:border-primary transition-colors duration-200 {{ $status == $tab['value'] ? 'border-b-2 border-primary text-primary font-semibold' : 'text-gray-500 border-transparent' }}">
                            {{ $tab['label'] }}
                        </button>
                    @endforeach
                </nav>
            </div>
        </div>

        {{-- <x-common::table.table :custom-table="$table" :datas="$datas" :sort="$sort" :order="$order" searchable>
            <x-slot name="searchAction">
                <livewire:common::utils.daterange-picker :value="$dates" />
            </x-slot>

            @forelse ($datas as $item)
                <tr wire:key="item-{{ $item->id }}">
                    <x-common::table.td>
                        <div class="flex items-center">
                            <div class="w-10 h-10 flex-shrink-0 mr-2">
                                <img src="{{ optional($item->customer)->getAvatar() }}"
                                     alt="{{ $item->billing_full_name }}" class="w-10 h-10 rounded-full">
                            </div>
                            <div>
                                {{ $item->billing_full_name }}
                            </div>
                        </div>
                    </x-common::table.td>
                    <x-common::table.td>
                        #{{ $item->order_code }}
                    </x-common::table.td>
                    <x-common::table.td>
                        {!! $item->orderStatusBadge() !!}
                    </x-common::table.td>
                    <x-common::table.td>
                        {{ $item->created_at->format('F d, Y') }}
                    </x-common::table.td>
                    <x-common::table.td>
                        {{ $item->details_count }} product(s)
                    </x-common::table.td>
                    <x-common::table.td>
                        {{ price($item->order_paid_nominal, true) }}
                    </x-common::table.td>
                    <x-common::table.td>
                        <button class="btn outline-primary text-xs" wire:loading.class="opacity-50 cursor-not-allowed"
                                x-on:click="showOrderModal = !showOrderModal"
                                wire:click="showOrder('{{ $item->order_code }}')">
                            <i class="bx bx-show mr-2"></i> Rincian
                        </button>
                    </x-common::table.td>
                </tr>
            @empty
                <tr>
                    <td colspan="{{ count($table->columns) }}">
                        <p class="text-center p-4">
                            Tidak ada pesanan yang ditemukan sesuai kriteria pencarian Anda.
                        </p>
                    </td>
                </tr>
            @endforelse
        </x-common::table.table> --}}
    </div>
    <livewire:administrator::order.show />
</div>
