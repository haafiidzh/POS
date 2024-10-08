<div>
    <h6 class="uppercase text-sm text-gray-600">Data Pengunjung Website</h6>
    <hr class="my-2">
    <div class="bg-white shadow rounded mb-3">
        <div class="p-4">
            <div class="flex flex-wrap justify-between">
                <div class="w-full md:w-1/2 lg:w-1/4 mb-3 lg:mb-0">
                    <h3 class="mb-0 text-xl">Analytics</h3>
                    <span class="text-gray-500">
                        {{ carbon($dates['start'])->format('d M Y') . ' - ' . carbon($dates['end'])->format('d M Y') }}
                    </span>
                </div>
                <div class="w-full lg:w-1/4 lg:ml-auto flex items-center justify-end">
                    <livewire:common::utils.daterange-picker :value="$dates" />

                    <div x-data="{ open: false }" class="relative mx-4">
                        <button class="relative bg-gray-800 text-white px-3 py-2 rounded-md" type="button" id="downloadDropdown" @click="open = !open">
                            Unduh
                        </button>
                        <ul x-show="open" @click.away="open = false" class="absolute right-0 z-10 w-32 mt-2 bg-white border border-gray-200 rounded shadow-lg"
                            aria-labelledby="downloadDropdown" x-cloak>
                            <li>
                                <a class="block px-4 py-2 text-gray-700 hover:bg-gray-100" href="javascript:void(0)" wire:click="downloadFile('xlsx')">Excel</a>
                            </li>
                            <li>
                                <a class="block px-4 py-2 text-gray-700 hover:bg-gray-100" href="javascript:void(0)" wire:click="downloadFile('csv')">CSV</a>
                            </li>
                        </ul>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    <livewire:administrator::visitor.summary />

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-6">
        <livewire:administrator::visitor.chart :dates="$dates" />
        <livewire:administrator::visitor.pie />
    </div>
</div>

@push('script')

    <script>
        document.addEventListener('livewire:load', function() {
            Livewire.on('openDownloadFile', function(url) {
                window.open(url, '_blank');
            });
        });
    </script>
    <script src="{{ asset('assets/public/js/vendor/chartjs.js') }}"></script>

    
@endpush
