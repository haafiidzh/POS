<div>
    @if (!$groups->isEmpty())
    <div class="card mb-3 xl:max-w-[calc(100vw-300px)] bg-white  shadow rounded-lg">
        <div class="px-4 md:px-6">
            <div class="flex flex-col">
                <!-- Tab Navigation -->
                <nav class="flex flex-wrap border-gray-200 border-b  md:border-b-0 md:border-r focus:ring-4 focus:ring-blue-300 active focus:outline-none md:pr-4 border-lg">
                    @foreach ($groups as $tab)
                        @php
                            $active = $group == $tab ? 'border-primary text-primary font-semibold ' : 'border-lg text-gray-500 hover:text-primary';
                        @endphp
                        <button type="button" wire:click="$set('group', '{{ $tab }}')"
                                class="p-4 border-b-2  m-4 {{ $active }} text-sm whitespace-nowrap flex-shrink-0">
                            {{ Str::title(unSlug($tab)) }}
                        </button>
                    @endforeach
                </nav>

                <!-- Tab Content -->
                <div class="mt-4 md:mt-0 md:ml-4 flex-1">
                    <!-- Your tab content goes here -->
                </div>
            </div>
        </div>
    </div>
@endif


    <x-common::table.table :custom-table="$table" :datas="$datas" :sort="$sort" :order="$order" searchable>
        @forelse ($datas as $seo)
            <tr>
                <x-common::table.td>
                    <p class="capitalize font-bold">{{ $seo->name }}</p>
                    <small class="text-slate-400">{{ $seo->key }}</small>
                </x-common::table.td>

                <x-common::table.td>
                    @if ($seo->type == 'image' && $seo->value)
                        <img src="{{ url($seo->value) }}" style="height: 80px" alt="">
                    @endif

                    @if (($seo->type == 'input' || $seo->type == 'textarea' || $seo->type == 'editor') && $seo->value)
                        <p class="m-0 overflow-hidden" style="max-width: 100%; white-space: normal; max-height: 100px">
                            @if (filter_var($seo->value, FILTER_VALIDATE_URL))
                                <a class="text-primary" href="{{ $seo->value }}"
                                   target="_blank">{{ $seo->value }}</a>
                            @elseif (filter_var($seo->value, FILTER_VALIDATE_EMAIL))
                                <a class="text-primary" href="mailto:{{ $seo->value }}">{{ $seo->value }}</a>
                            @else
                                {!! $seo->value !!}
                            @endif
                        </p>
                    @endif

                    @if (!$seo->value)
                        <p class="m-0">-</p>
                    @endif
                </x-common::table.td>

                <x-common::table.td class="flex gap-2 justify-center">
                    @can('update.setting-seo', 'web')
                        <a class="btn bg-light/75 text-slate-400 hover:bg-light hover:text-slate-600 px-2"
                           href="{{ route('administrator.setting.seo.edit', $seo->id) }}">
                            <i class="bx bx-edit"></i>
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
</div>
