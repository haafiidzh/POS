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
            <h5 class="card-title mb-0 pb-1">Tambah Transaction</h5>
            <p>Ini adalah deskripsi bantuan untuk mengisi form pada halaman transaction.</p>
            <form wire:submit.prevent="store">
                <div class="form-row">

                    {{-- Name --}}
                    <div class="form-group md:w-6/12">
                        <label for="name">Nama</label>
                        <input type="text" class="form-input" id="name" placeholder="Masukkan nama..."
                               wire:model.defer="name">
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @else
                            <small class="text-muted"><em>Teks bantuan untuk form Nama</em></small>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="form-group md:w-6/12">
                        <label for="email">Email</label>
                        <input type="email" class="form-input" id="email" placeholder="Masukkan email aktif..."
                               wire:model.defer="email">
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @else
                            <small class="text-muted"><em>Teks bantuan untuk form email</em></small>
                        @enderror
                    </div>
                </div>

                {{-- Alamat --}}
                <div class="form-group">
                    <label for="address">Alamat</label>
                    <textarea type="text" class="form-input" id="address" placeholder="1234 Main St" wire:model.defer="address"></textarea>
                    @error('address')
                        <small class="text-danger">{{ $message }}</small>
                    @else
                        <small class="text-muted"><em>Teks bantuan untuk form alamat</em></small>
                    @enderror
                </div>

                <div class="form-row">
                    {{-- Status --}}
                    <div class="form-group md:w-4/12">
                        <label for="state">Status</label>
                        <select id="state" class="form-input custom-select" wire:model.defer="state">
                            <option selected="">Pilih Status...</option>
                            <option value="active">Aktif</option>
                            <option value="inactive">Tidak Aktif</option>
                        </select>

                        @error('status')
                            <small class="text-danger">{{ $message }}</small>
                        @else
                            <small class="text-muted"><em>Teks bantuan untuk form Status</em></small>
                        @enderror
                    </div>

                    {{-- Harga --}}
                    <div class="form-group md:w-3/12">
                        <label for="price">Harga</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="price">Rp.</span>
                            </div>
                            <input type="text" class="form-input" id="price" placeholder="Masukkan harga..."
                                   wire:model.defer="price">
                        </div>
                        @error('price')
                            <small class="text-danger">{{ $message }}</small>
                        @else
                            <small class="text-muted"><em>Teks bantuan untuk form harga</em></small>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    {{-- Check --}}
                    <div class="form-group">
                        <input class="form-checkbox rounded text-primary" type="checkbox" id="check" name="check"
                               wire:model.defer="check">
                        <labelclass="custom-control-label"
                        for="check">
                        Check me out
                        </label>
                        <br>
                        @error('check')
                            <small class="text-danger">{{ $message }}</small>
                        @else
                            <small class="text-muted"><em>Teks bantuan untuk form check</em></small>
                        @enderror
                    </div>

                    {{-- Toggle --}}
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="form-checkbox rounded text-primary" id="toggle" name="toggle"
                               wire:model.defer="toggle">
                        <labelclass="custom-control-label"
                        for="toggle">Toggle this switch element</label>
                        <br>
                        @error('toggle')
                            <small class="text-danger">{{ $message }}</small>
                        @else
                            <small class="text-muted"><em>Teks bantuan untuk form toggle</em></small>
                        @enderror
                    </div>
                </div>

                {{-- Save Button --}}
                <x-common::utils.button class="btn bg-dark" :disabled="false" :loading="true" target="store">
                    Simpan
                </x-common::utils.button>
            </form>
        </div>
    </div>
</div>
