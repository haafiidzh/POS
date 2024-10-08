<div>
    <div x-data="{
        show_sidebar: false,
        toggleSidebar: function() {
            this.show_sidebar = !this.show_sidebar
            const is_open = this.show_sidebar;
            const body = document.body;
            body.classList.toggle('sidebar-filter-show')
        },
        clear: function() {
            this.toggleSidebar()
        }
    }" wire:ignore>
        <div class="sidebar-filter" id="scrollTarget" x-bind:class="show_sidebar ? 'show' : ''">
            <aside class="sidebar-outer -translate-x-full" x-show="show_sidebar">
                <div class="sidebar-wrapper">

                    <div class="my-2 flex items-center justify-end">
                        <button type="button"
                                class="p-1 text-slate-500 outline-white mr-2 inline-flex items-center text-sm"
                                wire:click="resetFilter" x-on:click="clear">
                            <i class="bx bx-reset mr-1"></i>
                            Reset
                        </button>
                        <button class="inline-flex items-center p-1 text-sm text-gray-500 rounded-full hover:bg-gray-100 focus:outline-none font-medium"
                                x-on:click="toggleSidebar" type="button">
                            <i class="bx text-xl bx-x"></i>
                        </button>
                    </div>

                    <p class="text-lg font-semibold mb-4 text-slate-700">Filter</p>

                    <form wire:submit.prevent="applyFilter">
                        <div class="flex flex-col">
                            <div class="form-group">
                                <label>Pencarian</label>
                                <input type="text" name="search" class="form-input"
                                       placeholder="Mau cari postingan apa?" wire:model.defer="search">
                            </div>

                            <div class="form-group">
                                <label>Kategori</label>
                                <select name="category" id="category" class="form-input" wire:model="category">
                                    <option value="">Semua Kategori</option>
                                    @foreach ($categories as $cat)
                                        @if ($cat->childs->count() > 0)
                                            <optgroup label="{{ $cat->name }}">
                                                @foreach ($cat->childs as $child)
                                                    <option value="{{ $child->slug }}">{{ $child->name }}</option>
                                                @endforeach
                                            </optgroup>
                                        @else
                                            <option value="{{ $cat->slug }}">{{ $cat->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Urut Berdasarkan</label>
                                <select name="sort" id="sort" class="form-input" wire:model.defer="sort">
                                    @foreach ($sort_order as $order)
                                        <option value="{{ $order['value'] }}">{{ $order['label'] }}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>

                        <hr class="my-3">
                        <button class="btn block primary mb-2" x-on:click="toggleSidebar">Terapkan</button>
                    </form>
                </div>
            </aside>
        </div>

        <div class="sidebar-content pt-10 pb-6 px-4">
            <button class="inline-flex items-center p-2 text-sm bg-gray-100 text-gray-500 rounded-lg hover:bg-gray-100 focus:outline-none ring-2 ring-gray-200 font-medium"
                    x-on:click="toggleSidebar" type="button">
                <i class="bx text-xl mr-1" x-bind:class="show_sidebar ? 'bx-x' : 'bx-menu'"></i> Filter
            </button>
        </div>
    </div>

    <div class="sidebar-content p-4" wire:loading.class="skeleton" wire:target="applyFilter,resetFilter">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-5 gap-6">
            @forelse ($datas as $post)
                <x-front::utils.card-post :post="$post" />
            @empty
                <div class="col-span-1 sm:col-span-2 md:col-span-3 xl:col-span-5">
                    <x-front::utils.404 class="border">
                        Upsss... Sepertinya kami tidak menemukan postingan yang kamu Cari. Coba cari menggunakan
                        filter yang lain.
                    </x-front::utils.404>
                </div>
            @endforelse
        </div>
        {{ $datas->onEachSide(0)->links('livewire::front-tailwind') }}
    </div>
</div>

@push('script')
    <script>
        (function() {
            /**
             * Server side reset form input to default value
             * @param e
             */
            document.addEventListener('filter-reset', function(e) {
                const data = e.detail[0]
                Object.keys(data).map((key) => {
                    const el = document.querySelector(`.sidebar-filter ${key}`)

                    if (key.includes('radio')) {
                        el.checked = true
                    } else {
                        el.value = data[key] ? data[key] : ''
                    }
                });
            })
        })()
    </script>
@endpush
