<?php

namespace Modules\Administrator\Livewire\Visitor;

use Livewire\Component;
use App\Exports\VisitorWebExport;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Common\Models\Visitor;



class Table extends Component
{

    /**
     * Define array props
     * @var array
     */
    public $dates = [
        'start' => '',
        'end' => '',
    ];

    const UPDATED_DATERANGEPICKER = 'updatedDaterangePicker';


    /**
     * Define event listeners
     * @var array
     */
    public $listeners = [
        self::UPDATED_DATERANGEPICKER,
    ];

    /**
     * Define props value before component rendered
     * @return void
     */
    public function mount()
    {
        $this->dates['start'] = now()->startOfYear()->toDateString();
        $this->dates['end'] = now()->endOfYear()->toDateString();
    }

    public function updatedDaterangePicker(array $value)
    {
        $this->dates = $value;
    }

    public function downloadFile($format)
    {

        $startDate = $this->dates['start'];
        $endDate = $this->dates['end'];

        // Buat koleksi dari semua bulan dari Januari sampai Desember
        $allMonths = collect([
            ['year' => now()->year, 'month' => 1, 'name' => 'Januari'],
            ['year' => now()->year, 'month' => 2, 'name' => 'Februari'],
            ['year' => now()->year, 'month' => 3, 'name' => 'Maret'],
            ['year' => now()->year, 'month' => 4, 'name' => 'April'],
            ['year' => now()->year, 'month' => 5, 'name' => 'Mei'],
            ['year' => now()->year, 'month' => 6, 'name' => 'Juni'],
            ['year' => now()->year, 'month' => 7, 'name' => 'Juli'],
            ['year' => now()->year, 'month' => 8, 'name' => 'Agustus'],
            ['year' => now()->year, 'month' => 9, 'name' => 'September'],
            ['year' => now()->year, 'month' => 10, 'name' => 'Oktober'],
            ['year' => now()->year, 'month' => 11, 'name' => 'November'],
            ['year' => now()->year, 'month' => 12, 'name' => 'Desember'],
        ]);

        // Ambil data pengunjung dari database
        $monthlyVisitorsData = Visitor::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, COUNT(*) as count')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        // Gabungkan data bulan dengan data pengunjung
        $monthlyVisitors = $allMonths->map(function ($month) use ($monthlyVisitorsData) {
            $visitor = $monthlyVisitorsData->firstWhere('month', $month['month']);
            return [
                'year' => $month['year'],
                'month' => $month['month'],
                'month_name' => $month['name'],
                'count' => $visitor ? $visitor->count : 0,
            ];
        });

        if ($format === 'xlsx') {
            return Excel::download(new VisitorWebExport($monthlyVisitors), 'Visitors_' . date('dmyhis') . '.xlsx');
        } elseif ($format === 'csv') {
            return Excel::download(new VisitorWebExport($monthlyVisitors), 'Visitors_' . date('dmyhis') . '.csv');
        }
        abort(404);

    }

    public function render()
    {
        return view('administrator::livewire.visitor.table');
    }
}
