<div>
    <form wire:submit.prevent="update">
        <div class="flex flex-col md:flex-row gap-6">
            <div class="md:w-8/12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0 pb-1">Tentang Produk</h5>
                    </div>

                    <div class="card-body">
                        <div class="form-group-row flex-col md:flex-row">
                            <div class="form-group w-full md:w-6/12">
                                <label for="title">Judul</label>
                                <input id="title" type="text" class="form-input" name="title"
                                       wire:model.lazy="title">

                                @error('title')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>

                            <div class="form-group w-full md:w-6/12">
                                <label for="slug_title">Slug</label>
                                <div class="input-group prepend">
                                    <div class="text">/</div>
                                    <input id="slug_title" type="text" class="form-input rounded-none"
                                           name="slug_title" wire:model.lazy="slug_title">
                                </div>

                                @error('slug_title')
                                    <small class="text-danger">{{ $message }}</small>
                                @else
                                    <small class="text-muted">
                                        <em>*Judul singkat untuk link yang dapat diakses oleh publik</em>
                                    </small>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <labelfor="">Harga</label>
                            <input class="form-input" name="price" type="number" autocomplete="price" 
                                      wire:model="price"></input>

                            @error('price')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="description">Konten</label>
                            <livewire:common::utils.editor :value="$description" />

                            @error('description')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="md:w-4/12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0 pb-1">Pengaturan Produk</h5>
                    </div>

                    <div class="card-body">
                        <div class="form-group">
                            <livewire:common::utils.filepond :oldValue="$oldThumbnail" :compress="true" />

                            @error('thumbnail')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="category">Kategori</label>
                            <select class="form-input" title="Kategori" name="category" id="category"
                                    wire:model="category">
                                <option value="">Pilih Kategori</option>
                                @foreach ($categories as $cat)
                                    @if ($cat->childs->count() > 0)
                                        <optgroup label="{{ $cat->name }}">
                                            @foreach ($cat->childs as $child)
                                                <option value="{{ $child->id }}">{{ $child->name }}</option>
                                            @endforeach
                                        </optgroup>
                                    @else
                                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                    @endif
                                @endforeach
                            </select>

                            @error('category')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="tags">Tag</label>

                            <livewire:common::utils.tagify.tag :value="$tags" placeholder="Ketikkan tag disini..." />

                            @error('tags')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        @can('publish.article', 'web')
                            <div class="form-group">
                                <label for="publish">
                                    <input type="checkbox" class="form-checkbox rounded text-primary" id="publish"
                                           name="publish" wire:model="publish">
                                    Publish Produk?
                                </label>
                                @error('publish')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        @endcan

                        <div class="px-2">
                            {{-- Save Button --}}
                            <x-common::utils.button class="btn bg-dark text-white hover:bg-slate-900" :disabled="false"
                                                    :loading="true" target="update">
                                Simpan
                            </x-common::utils.button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
