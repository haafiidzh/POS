<div role="tabpanel" aria-labelledby="vertical-tab-with-border-item-1">
    <div class="card">
        <div class="card-header">
            <h5 class="text-slate-800">Ubah Kata Sandi</h5>
        </div>
        <hr class="mt-3">
        <div class="card-body">
            <form wire:submit.prevent="update">
                <div class="grid sm:grid-cols-2 gap-4">
                    <div class="form-group col-span-1">
                        <labelfor="password">Kata
                        sandi</label>
                        <input type="password" class="form-input" id="password" wire:model.defer="password">
                        @error('password')
                            <small class="text-red-500">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group col-span-1">
                        <label for="password_confirmation">Ulangi
                            kata sandi</label>
                        <input type="password" class="form-input" id="password_confirmation"
                               wire:model.defer="password_confirmation">
                        @error('password_confirmation')
                            <small class="text-red-500">{{ $message }}</small>
                        @enderror
                        @error('password_confirmation')
                            <small class="text-red-500">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="text-end">
                    {{-- Save Button --}}
                    <x-common::utils.button class="btn primary text-sm" :disabled="false" :loading="true"
                                            target="update">
                        Simpan
                    </x-common::utils.button>
                </div>
            </form>
        </div>
    </div>
</div>
