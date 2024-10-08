<div x-data="{ deleteConfirm: false }">
    <div class="card">
        <div class="px-4 md:px-6">
            <nav class="flex space-x-3 border-b" aria-label="Tabs">
                @foreach ($statuses as $stat)
                    @php
                        $active = $status == $stat['value'] ? 'active' : '';
                    @endphp
                    <button type="button" wire:click="$set('status', '{{ $stat['value'] }}')"
                        class="fc-tab-active:font-semibold fc-tab-active:border-primary fc-tab-active:text-primary py-4 px-1 inline-flex items-center gap-2 border-b-2 border-transparent -mb-px text-sm whitespace-nowrap text-gray-500 hover:text-primary {{ $active }}">
                        {{ $stat['label'] }}
                    </button>
                @endforeach
            </nav>
            <div class="grid md:grid-cols-2 my-3">
                <!-- Dropdown or other content can be here -->

                <div class="flex justify-end w-full">
                    <div class="input-group append w-full md:w-8/12 ml-auto">
                        <input type="text" class="form-input" id="search" name="search" wire:model.lazy="search"
                            placeholder="Pencarian...">
                        <span class="text">
                            <i class="bx bx-search"></i>
                        </span>
                    </div>
                </div>
            </div>


            <div class="mb-5" wire:loading.class="skeleton" wire:target="status">
                <table class="w-full table-auto border-collapse">
                    <thead>
                        <tr class="bg-gray-100 dark:bg-gray-800">
                            <th class="border px-4 py-2 text-left">Nama</th>
                            <th class="border px-4 py-2 text-left">User</th>
                            <th class="border px-4 py-2 text-left">Alamat</th>
                            <th class="border px-4 py-2 text-left">Provinsi</th>
                            <th class="border px-4 py-2 text-left">Kecamatan</th>
                            <th class="border px-4 py-2 text-left">Kabupaten</th>
                            <th class="border px-4 py-2 text-left">Desa</th>
                            <th class="border px-4 py-2 text-left">Nomor Identifikasi</th>
                            <th class="border px-4 py-2 text-left">Link Maps</th>
                            <th class="border px-4 py-2 text-left">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($datas as $data)
                            <tr wire:loading.class="animate-pulse pointer-events-none">
                                <!-- Address -->
                                <td class="border px-4 py-2">{{ $data->name }}</td>
                                <td class="border px-4 py-2">{{ $data->user->name }}</td>

                                <td class="border px-4 py-2">{{ $data->address }}</td>

                                <!-- Province -->

                                <td class="border px-4 py-2">
                                    {{ $data->province->name ?? 'No Province' }}
                                </td>

                                <!-- Regency -->
                                <td class="border px-4 py-2">
                                    {{ $data->regency->name ?? 'No Regency' }}
                                </td>


                                <!-- District -->
                                <td class="border px-4 py-2">
                                    {{ $data->district->name ?? 'No District' }}
                                </td>
                                <!-- Village -->
                                <td class="border px-4 py-2">
                                    {{ optional($data->village)->name }}
                                </td>

                                <!-- Identify Number -->
                                <td class="border px-4 py-2">{{ $data->identify_number }}</td>

                                <!-- Maps Link -->
                                <td class="border px-4 py-2">
                                    <a href="{{ $data->maps_link }}" target="_blank">{{ $data->maps_link }}</a>
                                </td>

                                <!-- Actions -->
                                <td class="border px-4 py-2">
                                    <x-common::utils.dropdown>
                                        <x-slot name="item">
                                            @if ($data->status !== 'hold')
                                                <x-common::utils.dropdown-item
                                                    wire:click="toggleStatus('{{ $data->id }}', 'hold')">
                                                    <i class="w-4 h-4 mr-2 bx bx-pause-circle"></i>
                                                    Hold
                                                </x-common::utils.dropdown-item>
                                            @endif

                                            @if ($data->status !== 'active')
                                                <x-common::utils.dropdown-item
                                                    wire:click="toggleStatus('{{ $data->id }}', 'active')">
                                                    <i class="w-4 h-4 mr-2 bx bx-check-circle"></i>
                                                    Active
                                                </x-common::utils.dropdown-item>
                                            @endif

                                            @if ($data->status !== 'pending')
                                                <x-common::utils.dropdown-item
                                                    wire:click="toggleStatus('{{ $data->id }}', 'pending')">
                                                    <i class="w-4 h-4 mr-2 bx bx-time-five"></i>
                                                    Pending
                                                </x-common::utils.dropdown-item>
                                            @endif

                                            <x-common::utils.dropdown-item
                                                href="{{ route('administrator.partner.edit', $data->id) }}">
                                                <i class="w-4 h-4 mr-2 bx bx-edit"></i>
                                                Edit
                                            </x-common::utils.dropdown-item>

                                            <x-common::utils.dropdown-item
                                                wire:click="$set('destroyId', '{{ $data->id }}')"
                                                x-on:click="deleteConfirm = !deleteConfirm">
                                                <i class="w-4 h-4 mr-2 bx bx-trash"></i>
                                                Hapus
                                            </x-common::utils.dropdown-item>
                                        </x-slot>
                                    </x-common::utils.dropdown>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="border px-4 py-4 text-center">
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
