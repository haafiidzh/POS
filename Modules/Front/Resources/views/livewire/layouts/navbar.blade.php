<header class="bg-red-500 p-4 flex justify-between items-center">
    <div class="flex items-center space-x-3">
        <img src="logo.png" alt="Logo" class="w-10 h-10">
        <h1 class="text-white text-xl font-bold">Logo POS</h1>
    </div>
    <div x-data="{ open: false }" class="relative">
        <button @click="open = !open" class="text-white flex items-center space-x-2">
            <span>Profile</span>
            <img src="profile.png" alt="Profile" class="w-8 h-8">
        </button>
        <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 bg-white rounded shadow-lg py-2 w-48">
            @foreach ($customer_menus as $menu)
            <a href="{{$menu['link']}}" class="block px-4 py-2 text-gray-700 hover:bg-gray-200">{{$menu['name']}}</a>
            @endforeach
        </div>
    </div>
</header>
