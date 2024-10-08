<div class="m-auto w-full grid grid-cols-4 md:grid-cols-5 lg:grid-cols-4 gap-4">
    <div class="bg-white rounded shadow px-6" >
        <div class="p-4">
            <div class="flex items-center mb-2">
                <span class="text-sm">Pengunjung Harian</span>
            </div>
            <div class="flex items-center">
                <h5 class="text-lg font-semibold">{{ $visitor_today }} Visitor</h5>
            </div>
        </div>
    </div>
    <div class="bg-white rounded shadow px-6">
        <div class="p-4">
            <div class="flex items-center mb-2">
                <span class="text-sm">Pengunjung Mingguan</span>
            </div>
            <div class="flex items-center">
                <h5 class="text-lg font-semibold">{{ $visitor_weekly }} Visitor</h5>
            </div>
        </div>
    </div>
    <div class="bg-white rounded shadow px-6">
        <div class="p-4">
            <div class="flex items-center mb-2">
                <span class="text-sm">Pengunjung Bulanan</span>
            </div>
            <div class="flex items-center">
                <h5 class="text-lg font-semibold">{{ $visitor_monthly }} Visitor</h5>
            </div>
        </div>
    </div>
    <div class="bg-white rounded shadow px-6">
        <div class="p-4">
            <div class="flex items-center mb-2">
                <span class="text-sm">Pengunjung Tahunan</span>
            </div>
            <div class="flex items-center">
                <h5 class="text-lg font-semibold">{{ $visitor_yearly }} Visitor</h5>
            </div>
        </div>
    </div>
</div>
