<!-- Content -->
<div class="container mx-auto p-4 flex flex-col lg:flex-row space-y-4 lg:space-y-0 lg:space-x-6">

    <!-- Left section (Categories & Products) -->
    <div class="lg:w-3/4">
        <!-- Search & Categories -->
        <div class="mb-4">

            <x-common::utils.dropdown-filter2 :query="$category" property="category">
                {{ $categories->where('slug', $category)->first()?->name }}

                <x-slot name="item">
                    @foreach ($categories as $category)
                        <x-common::utils.dropdown-item2 wire:click="$set('category', '{{ $category->slug }}')">
                            {{ $category->name }}
                        </x-common::utils.dropdown-item2>
                    @endforeach
                </x-slot>
            </x-common::utils.dropdown-filter2>
            {{-- <div class="flex space-x-3 mt-3">
                <button class="bg-red-500 text-white px-4 py-2 rounded-full">Semua Kategori</button>
                <button class="bg-red-500 text-white px-4 py-2 rounded-full">Makanan</button>
                <button class="bg-red-500 text-white px-4 py-2 rounded-full">Minuman</button>
            </div> --}}
        </div>

        <!-- Products -->
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
            @foreach ($datas as $item)
                <div class="bg-white p-4 rounded-lg shadow-lg text-center" wire:click="addToCart('{{ $item->id }}')">
                    <img class="w-full object-cover object-center aspect-[4/3]"
                        src="{{ $item->thumbnail ? url($item->thumbnail) : 'https://via.placeholder.com/600x400/181818/ddd?text=' . $item->title }}"
                        alt="Gambar {{ $item->title }}">
                    <h2 class="text-lg font-semibold">{{ $item->title }}</h2>
                    <p class="text-gray-500">{{ formatRupiah($item->price) }}</p>
                </div>
            @endforeach
        </div>

    </div>

    <!-- Right section (Checkout) -->
    <div class="lg:w-1/3 bg-white p-4 rounded-lg shadow-lg">
        <h2 class="text-xl font-bold mb-4">Checkout</h2>
        <ul class="space-y-2 mb-4">
            <!-- Item List -->
            @foreach ($cart as $productId => $item)
                <li class="flex justify-between">
                    <div class="flex justify-between">
                    <button class="bg-gray-300 text-black px-4 py-1 rounded"
                        wire:click="decrementQuantity('{{ $productId }}')">
                        -
                    </button>
                    <span class="mx-3">{{ $item['quantity'] }}</span>
                    <button class="bg-gray-300 text-black px-4 py-1 rounded"
                        wire:click="incrementQuantity('{{ $productId }}')">
                        +
                    </button>
                    <span class="mx-3">{{ $item['name'] }}</span>
                </div>
                    
                    <div class="flex items-center ">
                        <span class="mx-3">{{ formatRupiah($item['price'] * $item['quantity']) }}</span>
                        <button class="bg-red-500 text-white ml-4 px-4 py-1 rounded"
                            wire:click="removeFromCart('{{ $productId }}')">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                </li>
                
            @endforeach
        </ul>
        <!-- Total and Cash Input -->
        <div class="border-t border-gray-300 py-2">
            <div class="flex justify-between">
                <span>Sub Total</span>
                <span>{{ formatRupiah($total) }}</span>
            </div>
            <div class="mt-4">
                <label for="cash" class="block mb-2">Cash</label>
                <input type="number" id="cash" class="w-full p-2 border rounded" wire:model="cash"
                    wire:change="calculateChange">
            </div>
            <div class="mt-2 flex space-x-2">
                <button class="bg-gray-200 px-4 py-2 rounded-lg" wire:click="setCash(10000)">10,000</button>
                <button class="bg-gray-200 px-4 py-2 rounded-lg" wire:click="setCash(20000)">20,000</button>
                <button class="bg-gray-200 px-4 py-2 rounded-lg" wire:click="setCash(50000)">50,000</button>
                <button class="bg-gray-200 px-4 py-2 rounded-lg" wire:click="setCash(100000)">100,000</button>
            </div>
            <div class="mt-4 flex justify-between">
                <span>Kembalian</span>
                <span>{{ formatRupiah($change) }} </span>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-between mt-6">
            <button class="bg-red-500 text-white px-4 py-2 rounded-lg">Cancel Order</button>
            <button class="bg-green-500 text-white px-4 py-2 rounded-lg">Send Order</button>
        </div>
    </div>
</div>
