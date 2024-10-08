<div x-data="{ deleteConfirm: false }">
    <div class="card">
        <div class="px-4 md:px-6">


            <div class="grid md:grid-cols-2 my-3 py-3">
                @if (auth()->user()->role != 'mitra')
                    <div class="flex flex-wrap w-full mb-3 md:m-0">
                        <x-common::utils.dropdown-filter :query="$partner" property="partner">
                            {{ $partners->where('name', $partner)->first()?->name }}
                            <x-slot name="item">
                                @foreach ($partners as $partner)
                                    <x-common::utils.dropdown-item wire:click="$set('partner', '{{ $partner->name }}')">
                                        {{ $partner->name }}
                                    </x-common::utils.dropdown-item>
                                @endforeach
                            </x-slot>
                        </x-common::utils.dropdown-filter>
                    </div>
                @endif

                <div class="input-group append w-full md:w-8/12 ms-auto">
                    <input type="text" class="form-input" id="search" name="search" wire:model.lazy="search"
                        placeholder="Pencarian...">
                    <span class="text">
                        <i class="bx bx-search"></i>
                    </span>
                </div>
            </div>


            <div class="mb-5" wire:loading.class="skeleton" wire:target="status">
                <table class="w-full table-auto border-collapse">
                    <thead>
                        <tr class="bg-gray-100 dark:bg-gray-800">
                            <th class="border px-4 py-2 text-left">Mitra</th>
                            <th class="border px-4 py-2 text-left">Tanggal Mulai</th>
                            <th class="border px-4 py-2 text-left">Tanggal Akhir</th>
                            <th class="border px-4 py-2 text-left">Tanggal Pembayaran</th>
                            <th class="border px-4 py-2 text-left">Nominal</th>
                            <th class="border px-4 py-2 text-left">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($datas as $data)
                            <tr wire:loading.class="animate-pulse pointer-events-none">
                                <!-- Partner -->
                                <td class="border px-4 py-2">{{ $data->partner->name }}</td>

                                <!-- Start Date -->
                                <td class="border px-4 py-2">{{ $data->start_date }}</td>

                                <!-- End Date -->
                                <td class="border px-4 py-2">{{ $data->end_date }}</td>

                                <!-- Payment Date -->
                                <td class="border px-4 py-2">{{ $data->payment_date ?? 'Belum dibayar' }}</td>

                                <!-- Nominal -->
                                <td class="border px-4 py-2">Rp {{ number_format($data->nominal, 2, ',', '.') }}</td>

                                <!-- Actions -->
                                <td class="border px-4 py-2">

                                    <x-common::utils.dropdown-item wire:click="$set('destroyId', '{{ $data->id }}')"
                                        x-on:click="deleteConfirm = !deleteConfirm">
                                        <i class="w-4 h-4 mr-2 bx bx-trash"></i>
                                        Hapus
                                    </x-common::utils.dropdown-item>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="border px-4 py-4 text-center">
                                    Data yang kamu cari tidak kami temukan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <x-common::utils.pagination :paginator="$datas" />
        </div>
    </div>

    <x-common::utils.remove-modal />
</div>
