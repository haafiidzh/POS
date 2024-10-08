<div x-data="{ showOrderModal: false }">
    <div class="card mb-5">
        <div class="card-body">
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="col-span-1" wire:loading.class="skeleton">
                    <h3 class="mb-0">Analytics</h3>
                    <span class="text-slate-500">
                        {{ carbon($dates['start'])->format('d M Y') . ' to ' . carbon($dates['end'])->format('d M Y') }}
                    </span>
                </div>
                <div class="lg:col-start-4 self-center">
                    <livewire:common::utils.daterange-picker :value="$dates" />
                </div>
            </div>
        </div>
    </div>

    <div class="flex gap-8">
        <ul class="card w-1/5">
            <li class="px-6 py-4">
                <a href=""><span class=" text-md">Harian</span></a>
            </li>
            <hr>
            <li class="px-6 py-4">
                <a href=""><span class=" text-md">Bulanan</span></a>
            </li>
        </ul>

        <div class="card flex-grow">
            <div class="my-3 ml-3" x-data="{ open: false }">
                <label for="selectPartner" class="form-label">Pilih Mitra :</label>

                <div class="relative">
                    <input type="text" placeholder="Cari Mitra..." x-model="search" @focus="open = true"
                        @blur="setTimeout(() => open = false, 100)" class="form-control" />

                    {{-- Dropdown List --}}
                    <div x-show="open"
                        class="absolute z-10 w-full bg-white border border-gray-300 mt-1 rounded-md shadow-lg max-h-60 overflow-auto">
                        <ul>
                            @foreach ($partners as $partner)
                                <li 
                                class="p-2 cursor-pointer hover:bg-gray-100"
                                wire:click="$updatePartner = '{{ $partner->id }}'; search = '{{ $partner->name }}'; open = false;">{{ $partner->name }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            {{-- <div class="mb-3">
                <label for="selectPartner" class="form-label">Pilih Mitra:</label>
                <select wire:model="selectedPartner" id="selectPartner" class="form-control">
                    <option value="">-- Pilih Mitra --</option>
                    @foreach ($partners as $partner)
                        <option value="{{ $partner->id }}">{{ $partner->name }}</option>
                    @endforeach
                </select>
            </div> --}}
            <x-common::table.table :custom-table="$table" :datas="$datas" :sort="$sort" :order="$order">
                {{-- @if ($selectedPartner) --}}
                    @forelse ($datas as $data)
                        <tr>
                            <x-common::table.td>{{ dateTimeTranslated($data->date) }}</x-common::table.td>
                            {{-- <x-common::table.td>{{ $data->partner->name }}</x-common::table.td> --}}
                            <x-common::table.td>Rp&nbsp;{{ number_format($data->total_cash, 0, ',', '.') }}</x-common::table.td>
                            <x-common::table.td>Rp&nbsp;{{ number_format($data->total_qris, 0, ',', '.') }}</x-common::table.td>
                            <x-common::table.td>Rp&nbsp;{{ number_format($data->total_sales, 0, ',', '.') }}</x-common::table.td>
                        </tr>
                    @empty
                        <tr>
                            <x-common::table.td colspan="{{ count($table->columns) }}" class="text-center">Tidak ada data</x-common::table.td>
                        </tr>
                    @endforelse
                {{-- @else
                <tr>
                    <x-common::table.td colspan="4" class="text-center">Silahkan Pilih Mitra Terlebih Dahulu</x-common::table.td>
                </tr>
                @endif --}}

            </x-common::table.table>
        </div>

    </div>

    {{-- <livewire:administrator::report.summary :dates="$dates" /> --}}
</div>
