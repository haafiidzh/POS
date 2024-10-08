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
                <div class="flex flex-wrap w-full mb-3 md:m-0">
                    <x-common::utils.dropdown-filter :query="$category" property="category">
                        {{ $categories->where('slug', $category)->first()?->name }}

                        <x-slot name="item">
                            @foreach ($categories as $category)
                                <x-common::utils.dropdown-item wire:click="$set('category', '{{ $category->slug }}')">
                                    {{ $category->name }}
                                </x-common::utils.dropdown-item>
                            @endforeach
                        </x-slot>
                    </x-common::utils.dropdown-filter>
                </div>
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
                            <th class="border px-4 py-2 text-left">Kategori</th>
                            <th class="border px-4 py-2 text-left">Tanggal Dibuat</th>
                            <th class="border px-4 py-2 text-left">Nominal</th>
                            <th class="border px-4 py-2 text-left">Jumlah Hari</th>
                            <th class="border px-4 py-2 text-left">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($datas as $data)
                            <tr wire:loading.class="animate-pulse pointer-events-none">
                                <!-- Thumbnail Image -->
                               
                                <!-- Category -->
                                <td class="border px-4 py-2 font-bold text-gray-800 dark:text-white">
                                    <a href="javascript:void(0)" wire:click="$set('category', '{{ $data->category->slug }}')"
                                       class="bg-light px-2 rounded-full text-xs">
                                        {{ optional($data->category)->name }}
                                    </a>
                                </td>
                                
                                <!-- Created Date -->
                                <td class="border px-4 py-2 text-gray-500 dark:text-gray-500">
                                    {{ dateTimeTranslated($data->created_at) }}
                                </td>
                                
                                <!-- Title -->
                                <td class="border px-4 py-2 font-bold text-gray-800 dark:text-white">
                                    {{ formatRupiah($data->nominal) }}
                                </td>
                                
                                <!-- Subject -->
                                <td class="border px-4 py-2 text-gray-800 dark:text-gray-400">
                                    {{ $data->number_of_days }}
                                </td>
                                
                              
                                <!-- Actions -->
                                <td class="border px-4 py-2">
                                    <x-common::utils.dropdown>
                                        <x-slot name="item">
                                            {{-- @can('update.product', 'web') --}}
                                            <x-common::utils.dropdown-item wire:click="archive('{{ $data->id }}')">
                                                <i class="w-4 h-4 mr-2 bx bx-{{ !$data->is_active ? 'upload' : 'archive-in' }}"></i>
                                                {{ !$data->is_active ? 'Pulihkan' : 'Arsipkan' }}
                                            </x-common::utils.dropdown-item>
                                            
                                            {{-- @endcan --}}
                                            
                                            {{-- @can('update.product', 'web') --}}
                                                <x-common::utils.dropdown-item href="{{ route('administrator.retribution.edit', $data->id) }}">
                                                    <i class="w-4 h-4 mr-2 bx bx-edit"></i>
                                                    Edit
                                                </x-common::utils.dropdown-item>
                                            {{-- @endcan --}}
                                            
                                            {{-- @can('delete.product', 'web') --}}
                                                <x-common::utils.dropdown-item wire:click="$set('destroyId', '{{ $data->id }}')"
                                                                               x-on:click="deleteConfirm = !deleteConfirm">
                                                    <i class="w-4 h-4 mr-2 bx bx-trash"></i>
                                                    Hapus
                                                </x-common::utils.dropdown-item>
                                            {{-- @endcan --}}
                                        </x-slot>
                                    </x-common::utils.dropdown>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="border px-4 py-4 text-center">
                                    Postingan yang kamu cari tidak kami temukan.
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
