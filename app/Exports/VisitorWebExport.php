<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;

class VisitorWebExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    use Exportable;

    protected $visitors;

    public function __construct($visitors)
    {
        $this->visitors = $visitors;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return collect($this->visitors)->map(function ($visitor, $index) {
            return [
                'No' => $index + 1,
                'Bulan' => $visitor['month_name'] . ' ' . $visitor['year'],
                'Total Visitor' => $visitor['count'] ?? '0',
            ];
        });
    }

    public function headings(): array
    {
        return [
            'No',
            'Month',
            'Total Visitor',
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $totalRow = $this->visitors->count() + 2; // Total row position (1 for header, 1 for total row)

                // Calculate total visitors
                $totalVisitors = $this->visitors->sum('count');

                // Add total row
                $event->sheet->setCellValue('B' . ($totalRow + 1), 'Total Visitors:');
                $event->sheet->setCellValue('C' . ($totalRow + 1), $totalVisitors);

                // Apply styling
                $event->sheet->getStyle('A' . ($totalRow + 1) . ':C' . ($totalRow + 1))
                    ->getFont()->setBold(true);
            },
        ];
    }
}
