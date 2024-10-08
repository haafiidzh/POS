<div role="tabpanel" aria-labelledby="vertical-tab-with-border-item-1" x-data="{
    cropModal: false
}">
    <div class="card">
        <div class="card-header">
            <h5 class="text-slate-800">Profil</h5>
        </div>
        <hr class="mt-3">
        <div class="card-body">
            <div class="relative h-20 w-20 overflow-hidden rounded-full bg-light cursor-pointer mb-4"
                 x-on:click="cropModal =! cropModal">
                <img class="w-full h-full object-center object-cover" id="avatar-target" src="{{ $oldAvatar }}"
                     alt="" wire:ignore>
                <div
                     class="bg-light absolute h-full w-full grid place-items-center opacity-0 hover:opacity-75 top-0 left-0 transition-all">
                    <i class="bx bx-pencil bxm"></i>
                </div>
            </div>

            <form wire:submit.prevent="update">
                <div class="grid sm:grid-cols-2 gap-4">
                    <div class="form-group col-span-1">
                        <labelfor="name">Nama
                        Lengkap</label>
                        <input type="text" class="form-input" id="name" wire:model.defer="name">
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group col-span-1">
                        <label for="email">Email</label>
                        <input type="email" class="form-input" id="email" wire:model.defer="email">
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
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
    <livewire:front::utils.avatar-cropper />
</div>
