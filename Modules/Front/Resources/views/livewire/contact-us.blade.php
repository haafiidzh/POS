<div class="lg:flex align-items-center">
    <div class="lg:w-1/2 m-auto">
        <div class="mb-6 relative bg-clip-border rounded-[0.1875rem]">
            <div class="py-12">
                <h2 class="mb-4 text-2xl/6 mt-0 font-medium">Punya Pertanyaan?</h2>
                <p class="mb-12 text-slate-400 text-base/6">
                    Silahkan isi formulir berikut dan kami akan segera menghubungi kamu kembali.
                </p>

                <form wire:submit.prevent="sendMessage" wire:key="{{ randAlpha() }}">
                    <div class="grid grid-cols-2 gap-2">
                        <div class="form-group col-span-1">
                            <label for="name">
                                Nama Lengkap
                                <span class="text-red-500">*</span>
                            </label>
                            <input type="text" class="form-input" id="name" placeholder="Nama lengkap kamu"
                                   wire:model.defer="name">

                            @error('name')
                                <small class="text-red-500">{{ ucfirst($message) }}</small>
                            @enderror
                        </div>
                        <div class="form-group col-span-1">
                            <label for="name">
                                Topik
                                <span class="text-red-500">*</span>
                            </label>

                            <select name="topic" id="topic" class="form-input" wire:model.defer="topic">
                                <option value="">Pilih Topik</option>
                                @foreach ($topics as $item)
                                    <option value="{{ $item->value }}">{{ ucfirst($item->translated()) }}</option>
                                @endforeach
                            </select>

                            @error('name')
                                <small class="text-red-500">{{ ucfirst($message) }}</small>
                            @enderror
                        </div>
                        <div class="form-group col-span-1">
                            <label for="email">
                                Email
                                <span class="text-red-500">*</span>
                            </label>
                            <input type="email" class="form-input" id="email" placeholder="Email kamu"
                                   wire:model.defer="email">

                            @error('email')
                                <small class="text-red-500">{{ ucfirst($message) }}</small>
                            @enderror
                        </div>
                        <div class="form-group col-span-1">
                            <label>
                                No. Whatsapp
                                <span class="text-red-500">*</span>
                            </label>
                            <div class="input-group prepend w-full">
                                <span
                                      class="text left !bg-transparent !pl-4 !pr-0 !text-slate-700 !text-[14px]">+62</span>
                                <x-front::utils.input-phone class="pl-[.2rem]" property="whatsapp_number"
                                                            :value="$whatsapp_number" />
                            </div>

                            @error('whatsapp_number')
                                <small class="text-red-500">{{ ucfirst($message) }}</small>
                            @enderror
                        </div>
                        <div class="form-group col-span-2">
                            <label for="subject">
                                Subjek
                                <span class="text-red-500">*</span>
                            </label>
                            <input type="text" class="form-input" id="subject"
                                   placeholder="Kamu ingin bertanya seputar apa?" wire:model.defer="subject">
                            @error('subject')
                                <small class="text-red-500">{{ ucfirst($message) }}</small>
                            @enderror
                        </div>
                        <div class="col-span-2">
                            <div class="form-group">
                                <label for="message">
                                    Pesan
                                    <span class="text-red-500">*</span>
                                </label>
                                <textarea class="form-input" id="message" rows="4" placeholder="Tinggalkan kami pesan..."
                                          wire:model.defer="message"></textarea>
                                @error('message')
                                    <small class="text-red-500">{{ ucfirst($message) }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        {{-- Save Button --}}
                        <x-common::utils.button class="btn primary text-sm" :disabled="false" :loading="true"
                                                target="sendMessage">
                            <i class="bx bxend mr-2"></i>
                            Kirim Pertanyaan
                        </x-common::utils.button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
