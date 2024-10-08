<div x-data="{
    deleteConfirm: false,
    createModal: false,
    editModal: false
}">
    <div class="grid md:grid-cols-12 gap-6">
        <div class="md:col-span-7 flex flex-col gap-6">
            <div class="card p-6">
                <div class="flex justify-between items-center mb-4">
                    <h4 class="card-title">Daftar Tipe</h4>

                    @can('create.course-type', 'web')
                        <button type="button" class="btn bg-primary text-white pl-3" x-on:click="createModal =!createModal;"
                                wire:click="$dispatch('initModal')">
                            <i class="bx bx-plus text-base me-3"></i> Tipe
                        </button>
                    @endcan
                </div>

                <div class="input-group append w-full md:w-6/12 ms-auto mb-4">
                    <input type="text" class="form-input" id="search" name="search" wire:model.lazy="search"
                           placeholder="Pencarian...">
                    <span class="text">
                        <i class="bx bx-search"></i>
                    </span>
                </div>

                <div class="flex flex-col" wire:sortable="updateOrder" wire:sortable-group="updateTypeOrder"
                     wire:sortable.options="{ animation: 50 }">
                    @foreach ($types as $type)
                        <div wire:sortable.item="{{ $type->id }}" wire:key="group-{{ $type->id }}"
                             title="{{ !$type->is_active ? 'Tipe Non-aktif' : null }}"
                             class="w-full gap-x-2 py-2.5 px-2 md:px-4 text-sm font-medium border text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg dark:bg-gray-800 dark:border-gray-700 dark:text-white {{ $type->is_active ?: 'bg-gray-50' }}">

                            <div class="flex justify-between">
                                <a class="btn pl-0 text-left {{ $type->is_active ?: 'text-muted' }}">
                                    @if ($type->is_featured)
                                        <i class="bx bxs-star bx-xs mr-1" title="Tipe unggulan"></i>
                                    @else
                                        <i class="bx bx-xs" style="margin-right: 1.25rem"></i>
                                    @endif
                                    {{ $type->name }}
                                </a>

                                <div class="flex mx-2">
                                    @can('update.course-type', 'web')
                                        <a class="btn px-1 md:px-2 py-0 text-xs rounded-e-none bg-light"
                                           href="javascript:void(0)" wire:click="edit('{{ $type->id }}')"
                                           x-on:click="editModal =!editModal">
                                            <i class="bx bx-edit"></i>
                                        </a>
                                    @endcan

                                    @can('delete.course-type', 'web')
                                        <a class="btn px-1 md:px-2 py-0 text-xs rounded-s-none bg-light"
                                           href="javascript:void(0)" wire:click="$set('destroyId', '{{ $type->id }}')"
                                           x-on:click="deleteConfirm =!deleteConfirm">
                                            <i class="bx bx-trash"></i>
                                        </a>
                                    @endcan

                                    @can('update.course-type', 'web')
                                        <button type="button"
                                                class="btn px-1 md:px-2 py-0 text-xs bg-dark cursor-grab active:cursor-grabbing text-white ms-2"
                                                wire:sortable.handle title="Tahan untuk memindahkan posisi">
                                            <i class="bx bx-sort-alt-2"></i>
                                        </button>
                                    @endcan
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                @if (!$types->isEmpty())
                    <div class="mt-3">
                        <x-common::utils.pagination :paginator="$types" />
                    </div>
                @endif
            </div>

        </div>
    </div>

    @can('create.course-type', 'web')
        <livewire:administrator::course-type.create />
    @endcan

    @can('update.course-type', 'web')
        <livewire:administrator::course-type.edit />
    @endcan

    @can('delete.course-type', 'web')
        <x-common::utils.remove-modal />
    @endcan
</div>
