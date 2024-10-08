<div x-data="{
    deleteConfirm: false,
    createModal: false,
    editModal: false
}">

    {{-- <x-common::table.table :custom-table="$table" :datas="$datas" :sort="$sort" :order="$order" searchable>

        @can('create.ecommerce_setting-coupon', 'web')
            <x-slot name="searchAction">
                <button type="button" class="btn primary w-full" x-on:click="createModal =!createModal;"
                        wire:click="$dispatch('initModal')"><i class="bx bx-plus me-2"></i> Tambah</button>
            </x-slot>
        @endcan

        @forelse ($datas as $coupon)
            <tr>
                <x-common::table.td>
                    <span class="whitespace-nowrap font-semibold">{{ $coupon->code }}</span>
                    <div x-data="{ expanded: false }">
                        <p class="text-slate-500 max-w-96" x-bind:class="expanded ? '' : 'line-clamp-2'"
                           x-on:mouseenter="expanded = !expanded" x-on:mouseleave="expanded = !expanded">
                            {{ $coupon->description }}
                        </p>
                    </div>
                </x-common::table.td>
                <x-common::table.td>
                    @if ($coupon->getCouponValue())
                        <small class="badge soft-dark">
                            <strong>Diskon:</strong>
                            {{ $coupon->getCouponValue() }}
                        </small>
                        @if ($coupon->getMaxDiscount())
                            <small class="badge soft-dark">
                                <strong>Hingga:</strong>
                                {{ $coupon->getMaxDiscount() }}
                            </small>
                        @endif

                        @if ($coupon->getMinPurchase())
                            <small class="badge soft-dark">
                                <strong>Min.:</strong>
                                {{ $coupon->getMinPurchase() }}
                            </small>
                        @endif
                    @else
                        <p class="text-center">-</p>
                    @endif
                </x-common::table.td>
                <x-common::table.td>
                    @if ($coupon->expiry_date)
                        @if (carbon($coupon->expiry_date) < now())
                            <small class="badge soft-dark">
                                Expired
                            </small>
                        @elseif (carbon($coupon->expiry_date) > now() && carbon($coupon->expiry_date)->diffInDays(now()) < 5)
                            <small class="badge soft-danger">
                                {{ dateTimeTranslated($coupon->expiry_date) }}
                            </small>
                        @else
                            <small class="badge soft-primary">
                                {{ dateTimeTranslated($coupon->expiry_date) }}
                            </small>
                        @endif
                    @else
                        <p class="text-center">-</p>
                    @endif
                </x-common::table.td>
                <x-common::table.td>
                    @if ($coupon->getQuota())
                        <small class="badge soft-dark">
                            {{ $coupon->getQuota() }}
                        </small>
                    @else
                        <p class="text-center">-</p>
                    @endif
                </x-common::table.td>
                <x-common::table.td>
                    {!! $coupon->statusBadge() !!}
                </x-common::table.td>
                <x-common::table.td class="flex gap-2 justify-center">
                    @can('update.ecommerce_setting-coupon', 'web')
                        <a class="btn bg-light px-2" href="javascript:void(0)" wire:click="edit('{{ $coupon->id }}')"
                           x-on:click="editModal = !editModal">
                            <i class="bx bx-edit"></i>
                        </a>
                    @endcan

                    @can('delete.ecommerce_setting-coupon', 'web')
                        <a class="btn bg-danger/25 text-danger hover:bg-danger hover:text-white px-2"
                           href="javascript:void(0)" wire:click="$set('destroyId', '{{ $coupon->id }}')"
                           x-on:click="deleteConfirm =!deleteConfirm">
                            <i class="bx bx-trash"></i>
                        </a>
                    @endcan
                </x-common::table.td>
            </tr>
        @empty
            <tr>
                <td colspan="{{ count($table->columns) }}">
                    <p class="text-center p-4">
                        Data yang kamu cari, tidak kami ditemukan.
                    </p>
                </td>
            </tr>
        @endforelse
    </x-common::table.table>

    <x-common::utils.remove-modal /> --}}

    @can('create.ecommerce_setting-coupon', 'web')
        <livewire:administrator::coupon.create />
    @endcan
    @can('update.ecommerce_setting-coupon', 'web')
        <livewire:administrator::coupon.edit />
    @endcan
</div>
