<div x-data="{ showFile: false }">
    <div class="flex gap-4 w-full">
        <div class="card w-1/2 px-4 py-5 md:px-6">
            <div wire:loading.class="skeleton" wire:target="status">
                <table class="w-full table-auto border-collapse">
                    <thead>
                        <tr class="bg-gray-100 dark:bg-gray-800">
                            <th class="border px-4 py-2 text-left">Detail Pesanan</th>
                            <th class="border px-4 py-2 text-left">Deskripsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr wire:loading.class="animate-pulse pointer-events-none">
                            <td class="border px-4 py-2">ID Transaksi</td>
                            <td class="border px-4 py-2">{{ $datas->id }}</td>
                        </tr>
                        <tr wire:loading.class="animate-pulse pointer-events-none">
                            <td class="border px-4 py-2">Tanggal Transaksi</td>
                            <td class="border px-4 py-2">{{ dateTimeTranslated($datas['transaction_date']) }}</td>
                        </tr>
                        <tr wire:loading.class="animate-pulse pointer-events-none">
                            <td class="border px-4 py-2">Nama Mitra</td>
                            <td class="border px-4 py-2">{{ $datas->partner->name }}</td>
                        </tr>
                        <tr wire:loading.class="animate-pulse pointer-events-none">
                            <td class="border px-4 py-2">Subtotal</td>
                            <td class="border px-4 py-2">Rp&nbsp;{{ number_format($datas->total_amount, 0, ',', '.') }}
                            </td>
                        </tr>
                        <tr wire:loading.class="animate-pulse pointer-events-none">
                            <td class="border px-4 py-2">Total Bayar</td>
                            <td class="border px-4 py-2">Rp&nbsp;{{ number_format($datas->value, 0, ',', '.') }}</td>
                        </tr>
                        <tr wire:loading.class="animate-pulse pointer-events-none">
                            <td class="border px-4 py-2">Kembalian</td>
                            <td class="border px-4 py-2">Rp&nbsp;{{ number_format($datas->change_amount, 0, ',', '.') }}
                            </td>
                        </tr>
                        <tr wire:loading.class="animate-pulse pointer-events-none">
                            <td class="border px-4 py-2">Metode Pembayaran</td>
                            @if ($datas->payment_method == 'cash')
                                <td class="border px-4 py-2 ">
                                    <div class="flex items-center">
                                        <i class='bx bx-money text-lg text-success'></i>&nbsp;<span>Cash</span>
                                    </div>
                                </td>
                            @else
                                <td class="border px-4 py-2 ">
                                    <div class="flex items-center">
                                        <i class='bx bx-qr text-lg text-info'></i>&nbsp;<span>QRIS</span>
                                    </div>
                                </td>
                            @endif
                        </tr>
                        @if ($datas->payment_method == 'qris' && $datas->thumbnail == !null)
                            <tr>
                                <td class="border px-4 py-2">Bukti Pembayaran</td>
                                <td class="border px-4 py-2">
                                    <a class="text-info" href="javascript:void(0)" x-on:click="showFile =!showFile">Lihat Bukti Pembayaran</a>
                                </td>
                            </tr>
                        @else
                            <tr>
                                <td class="border px-4 py-2">Bukti Pembayaran</td>
                                <td class="border px-4 py-2">
                                    <span>Tidak Ada</span>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card w-1/2 px-4 py-5 md:px-6">
            <table class="w-full table-auto border-collapse">
                <thead>
                    <tr class="bg-gray-100 dark:bg-gray-800">
                        <th class="border px-4 py-2 text-left" colspan="4">Detail Transaksi</th>
                    </tr>
                    <tr class="bg-gray-100 dark:bg-gray-800" wire:loading.class="animate-pulse pointer-events-none">
                        <td class="border px-4 py-2 font-semibold">Nama Produk</td>
                        <td class="border px-2 py-2 font-semibold">Harga Satuan</td>
                        <td class="border px-4 py-2 font-semibold">Kuantitas</td>
                        <td class="border px-4 py-2 font-semibold">Harga Total</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datas->details as $detail)
                        <tr wire:loading.class="animate-pulse pointer-events-none">
                            <td class="border px-4 py-2">{{ $detail->product->title }}</td>
                            <td class="border px-4 py-2">Rp&nbsp;{{ number_format($detail->price, 0, ',', '.') }}
                            </td>
                            <td class="border px-4 py-2">{{ $detail->quantity }}</td>
                            <td class="border px-4 py-2">
                                Rp&nbsp;{{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td class="border px-4 py-2 font-bold bg-gray-100" colspan="3">Total
                            Pembayaran</td>
                        <td class="border px-4 py-2 font-bold">
                            Rp&nbsp;{{ number_format($datas->total_amount, 0, ',', '.') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <x-common::utils.proof-modal :datas="$datas"/>
    </div>
</div>
