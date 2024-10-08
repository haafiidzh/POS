<div x-show="showFile" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog"
     aria-modal="true">
    <div class="flex items-end justify-center min-h-screen px-4 text-center md:items-center sm:block sm:p-0">
        <div x-cloak x-show="showFile" x-transition:enter="transition ease-out duration-300 transform"
             x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0" class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-40"
             aria-hidden="true"></div>

        <div x-cloak x-show="showFile" x-transition:enter="transition ease-out duration-300 transform"
             x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave="transition ease-in duration-200 transform"
             x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             class="inline-block w-[90%] max-w-xl overflow-hidden text-left transition-all transform bg-white rounded-lg shadow-xl absolute top-[25%] left-1/2 translate-x-[-50%]">

            <div class="flex items-center justify-between space-x-4">
                <button type="button"
                        class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        x-on:click="showFile = false">
                    <i class="bx bx-x"></i>
                </button>
            </div>

            <div class="p-6 text-center">
                <h3 class="text-lg flex justify-center font-normal text-gray-500 dark:text-gray-400">
                    <img src="{{ $datas->thumbnail ? url($datas->thumbnail) : 'https://via.placeholder.com/600x400/181818/ddd?text=' . $datas->title }}">
                </h3>
            </div>
            
        </div>
    </div>
</div>
