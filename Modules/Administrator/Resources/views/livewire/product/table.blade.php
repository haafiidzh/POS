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
                <div class="flex justify-around w-full mb-3 md:m-0">
                    <div class="px-2">
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

                    @if (auth()->user()->hasRole(['Developer', 'Super Admin'], 'web'))
                    <div class="px-2">
                        <x-common::utils.dropdown-filter :query="$creator" property="creator">
                            {{ $creators->where('name', $creator)->first()?->name }}
                            <x-slot name="item">
                                @foreach ($creators as $creator)
                                    <x-common::utils.dropdown-item wire:click="$set('creator', '{{ $creator->id }}')">
                                        {{ $creator->name }}
                                    </x-common::utils.dropdown-item>
                                @endforeach
                            </x-slot>
                        </x-common::utils.dropdown-filter>
                    </div>
                @endif
                </div>
                <div class="input-group append w-full md:w-8/12 ms-auto">
                    <input type="text" class="form-input" id="search" name="search" wire:model.lazy="search"
                        placeholder="Pencarian...">
                    <span class="text">
                        <i class="bx bx-search"></i>
                    </span>
                </div>
            </div>

            <div class="grid grid-cols-1 {{ !$datas->isEmpty() ? 'sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4' : '' }} gap-4 mb-5"
                wire:loading.class="skeleton" wire:target="status">
                @forelse ($datas as $data)
                    <div class="card overflow-hidden h-full relative"
                        wire:loading.class="animate-pulse pointer-events-none">
                        <div class="w-full overflow-hidden relative">
                            <img class="w-full object-cover object-center aspect-[4/3]"
                                src="{{ $data->thumbnail ? url($data->thumbnail) : 'https://via.placeholder.com/600x400/181818/ddd?text=' . $data->title }}"
                                alt="Gambar {{ $data->title }}">
                            <a class="bg-light px-2 rounded-full absolute bottom-2 left-2 text-xs"
                                href="javascript:void(0)" wire:click="$set('category', '{{ $data->category->slug }}')">
                                {{ optional($data->creator)->name }}
                            </a>
                        </div>

                        <div class="p-4 md:p-6 mb-20" style="min-height: 180px">
                            <div class="flex justify-between items-center">
                                <p class="m-0 text-xs text-gray-500 dark:text-gray-500">
                                    {{ dateTimeTranslated($data->created_at) }}
                                </p>
                                <x-common::utils.dropdown>
                                    <x-slot name="item">
                                        @can('update.product', 'web')
                                            <x-common::utils.dropdown-item wire:click="archive('{{ $data->id }}')">
                                                <i
                                                    class="w-4 h-4 me-3 bx bx-{{ !$data->archived_at ? 'archive-in' : 'upload' }}"></i>
                                                {{ !$data->archived_at ? 'Arsipkan' : 'Pulihkan' }}
                                            </x-common::utils.dropdown-item>
                                        @endcan

                                        @can('update.product', 'web')
                                            <x-common::utils.dropdown-item
                                                href="{{ route('administrator.product.edit', $data->id) }}">
                                                <i class="w-4 h-4 me-3 bx bx-edit"></i>
                                                Edit
                                            </x-common::utils.dropdown-item>
                                        @endcan

                                        @can('delete.product', 'web')
                                            <x-common::utils.dropdown-item
                                                wire:click="$set('destroyId', '{{ $data->id }}')"
                                                x-on:click="deleteConfirm =!deleteConfirm">
                                                <i class="w-4 h-4 me-3 bx bx-trash"></i>
                                                Hapus
                                            </x-common::utils.dropdown-item>
                                        @endcan
                                    </x-slot>
                                </x-common::utils.dropdown>
                            </div>
                            <div class="flex justify-between items-center py-2">
                                <!-- Left Content -->
                                <h3 class="text-lg font-bold text-gray-800 dark:text-white line-clamp-2">
                                    {{ $data->title }}
                                </h3>
                                
                                <!-- Right Content -->
                                <p class="text-gray-800 font-bold dark:text-white-400">
                                    {{ formatRupiah($data->price) }}
                                </p>
                            </div>

                        </div>
                        
                    </div>
                @empty
                    <div class="w-full pt-3 pb-3">
                        <div class="form-input py-3">
                            <p class="text-center m-0">Produk yang kamu cari tidak kami temukan.</p>
                        </div>
                    </div>
                @endforelse
            </div>

            <x-common::utils.pagination :paginator="$datas" />
        </div>
    </div>

    <x-common::utils.remove-modal />
</div>
