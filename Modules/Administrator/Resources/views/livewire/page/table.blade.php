<div>
    @if (session()->has('success'))
        <x-common::utils.alert class="primary mb-3" icon="bx bx-check-circle" title="Sukses!" dismissable>
            {{ session()->get('success') }}
        </x-common::utils.alert>
    @endif

    @if (session()->has('error'))
        <x-common::utils.alert class="warning mb-3" icon="bx bx-info-circle" title="Upss.. Tampaknya ada yang salah"
                               dismissable>
            {{ session()->get('error') }}
        </x-common::utils.alert>
    @endif

    <div class="card">
        <div class="p-6">

            <div class="form-group row">
                <div class="col-md-4 col-lg-3 ml-auto">
                    <div class="input-group">
                        <input type="text" class="form-input" id="search" name="search" wire:model.lazy="search"
                               placeholder="Pencarian...">
                        {{-- <div class="input-group-append">
                            <button type="button" class="btn bg-default right-sidebar-toggle" data-sidebar-id="main-right-sidebar">
                                <i class="fas fa-filter"></i>
                            </button>
                        </div> --}}
                    </div>
                </div>
            </div>

            <x-common::table.table :custom-table="$table" :datas="$datas" :sort="$sort" :order="$order" searchable>
                {{-- Table Filters --}}
                {{-- <x-slot name="filters">
                    <div class="form-group">
                        <select wire:model.defer="is_active" class="form-input form-input-sm h-100">
                            <option value="">-- Semua Status Halaman --</option>
                            <option value="true">Aktif</option>
                            <option value="false">Tidak Aktif</option>
                        </select>
                    </div>
                </x-slot> --}}

                {{-- Table Header --}}
                <x-slot name="table_headers">
                    {{-- @foreach ($headers as $header)
                        <x-admin.partials.table.cell :cell="$header['cell_name']" :isHeader="true" :sortable="$header['sortable']"
                                                     sortableOrder="{{ $header['column_name'] == $sort ? $order : null }}"
                                                     wire:click="sort('{{ $header['column_name'] }}')" />
                    @endforeach --}}
                </x-slot>

                {{-- Table Body --}}
                <x-slot name="table_body">
                    @forelse ($datas as $data)
                        <tr>
                            <td>{{ $data->title }}</td>
                            <td>{{ $data->short_description }}</td>
                            <td>
                                @if ($data->is_active)
                                    <div state="primary" icon="" text="Aktif" ></div>
                                @else
                                    <div state="dark" icon="" text="Tidak Aktif" ></div>
                                @endif
                            </td>
                            <td>{{ dateTimeTranslated($data->created_at) }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    {{-- <a class="btn btn-sm px-2 py-2 btn-light" target="_blank"
                                       href="{{ route('front.page', $data->slug) }}">
                                        <i class="bx bx-show"></i>
                                    </a> --}}
                                    @can('edit.page')
                                        <a class="btn btn-sm px-2 py-2 btn-light"
                                           href="{{ route('administrator.page.edit', $data->id) }}">
                                            <i class="bx bx-edit"></i>
                                        </a>
                                    @endcan
                                    @can('delete.page')
                                        <a class="btn btn-sm px-2 py-2 btn-light" href="javascript:void(0)"
                                           wire:click="$set('destroyId', '{{ $data->id }}')" data-toggle="modal"
                                           data-target="#remove-modal">
                                            <i class="bx bx-trash"></i>
                                        </a>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ count($headers) }}">
                                <p class="text-center m-0">Tidak ada data yang ditampilkan.</p>
                            </td>
                        </tr>
                    @endforelse
                </x-slot>

                {{-- Table Pagination --}}
                <x-slot name="pagination">
                    <x-common::utils.pagination :paginator="$datas" />
                </x-slot>
            </x-common::table.table>
        </div>
    </div>

    <x-common::utils.remove-modal />
</div>
