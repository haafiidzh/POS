<div>
    <form wire:submit.prevent="store">
        <div class="flex flex-col md:flex-row gap-6">
            <div class="md:w-8/12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0 pb-1">Tentang Retribusi</h5>
                    </div>

                    <div class="card-body">
                        <div class="form-group-row flex-col md:flex-row">
                            <div class="form-group w-full ">
                                <label for="nominal">Nominal</label>
                                <input id="nominal" type="number" class="form-input" name="nominal"
                                    wire:model.lazy="nominal">

                                @error('nominal')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
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

                        <div class="form-group mt-4" id="nominal-field"  style="display: none;">
                            <label for="number_of_days">Jumlah hari</label>
                            <input type="number" class="form-input" name="number_of_days" id="number_of_days"
                                wire:model="number_of_days" placeholder="Masukkan Jumlah Hari">
                                
                        </div>

                        <div class="form-group">
                            <label for="publish">
                                <input type="checkbox" class="form-checkbox rounded text-primary" id="publish"
                                    name="publish" wire:model="publish">
                                Publish Retribusi?
                            </label>
                            @error('publish')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="px-2">
                            {{-- Save Button --}}
                            <x-common::utils.button class="btn bg-dark text-white hover:bg-slate-900" :disabled="false"
                                :loading="true" target="store">
                                Simpan
                            </x-common::utils.button>
                        </div>
                    </div>
                </div>
            </div>

            
        </div>
    </form>
</div>
