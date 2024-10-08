<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Modules\Common\Models\TransactionDetail;
use Carbon\Carbon;
use Modules\Common\Models\Transaction;
use Illuminate\Support\Facades\Log;


class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Ambil nilai start_date, end_date, dan per_page dari query string
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');
        $perPage = $request->query('per_page', 10); // Default 10 items per page

        // Jika start_date atau end_date tidak diset, gunakan default
        if (!$startDate || !$endDate) {
            $startDate = Carbon::today()->toDateString(); // Tanggal hari ini
            $endDate = Carbon::tomorrow()->toDateString(); // Besok
        }

        // Ambil transaksi berdasarkan tanggal yang difilter
        $sales = Transaction::whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('DATE(created_at) as date, COUNT(*) as transaction_count, SUM(total_amount) as total_income')
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        // Loop hasil dan tambahkan nama hari menggunakan Carbon
        $salesWithDay = $sales->map(function ($sale) {
            $sale->day = Carbon::parse($sale->date)->locale('id')->isoFormat('dddd'); // Mendapatkan nama hari dalam bahasa Indonesia
            return $sale;
        });

        // Paginate hasil yang sudah diformat dengan nama hari
        $paginatedSales = $this->paginate($salesWithDay, $perPage);

        return response()->json($paginatedSales);
    }

    public function indexMonth(Request $request)
    {
        // Mengambil bulan dan tahun untuk rentang yang dipilih
        $startMonth = $request->query('start_month', Carbon::now()->month);
        $startYear = $request->query('start_year', Carbon::now()->year);
        $endMonth = $request->query('end_month', Carbon::now()->month);
        $endYear = $request->query('end_year', Carbon::now()->year);
    
        // Membuat array untuk menyimpan hasil
        $results = [];
    
        // Iterasi setiap bulan dari startMonth ke endMonth
        for ($year = $startYear; $year <= $endYear; $year++) {
            $start = ($year == $startYear) ? $startMonth : 1;
            $end = ($year == $endYear) ? $endMonth : 12;
    
            for ($month = $start; $month <= $end; $month++) {
                $startDate = Carbon::createFromDate($year, $month, 1)->startOfDay();
                $endDate = Carbon::createFromDate($year, $month, 1)->endOfMonth()->endOfDay();
    
                // Ambil transaksi berdasarkan bulan yang difilter
                $sales = Transaction::whereBetween('created_at', [$startDate, $endDate])
                    ->selectRaw('
                        COUNT(*) as transaction_count,
                        SUM(total_amount) as total_income,
                        SUM(CASE WHEN payment_method = "cash" THEN total_amount ELSE 0 END) as cash_payments,
                        SUM(CASE WHEN payment_method = "qris" THEN total_amount ELSE 0 END) as qris_payments
                    ')
                    ->first(); // Mengambil hanya satu hasil agregasi
    
                // Mendapatkan nama bulan dalam bahasa Indonesia
                $monthName = Carbon::createFromDate($year, $month)->locale('id')->isoFormat('MMMM');
    
                // Menyimpan hasil ke dalam array
                $results[] = [
                    'month_name' => $monthName,
                    'transaction_count' => $sales->transaction_count ?? 0,
                    'total_income' => $sales->total_income ?? 0,
                    'cash_payments' => $sales->cash_payments ?? 0,
                    'qris_payments' => $sales->qris_payments ?? 0,
                ];
            }
        }
    
        return response()->json($results);
    }
    



    /**
     * Helper function to paginate custom collections
     */
    protected function paginate($items, $perPage)
    {
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentItems = $items->slice(($currentPage - 1) * $perPage, $perPage);

        return new LengthAwarePaginator(
            $currentItems,
            $items->count(),
            $perPage,
            $currentPage,
            ['path' => LengthAwarePaginator::resolveCurrentPath()]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = TransactionDetail::where('id', $id)->get();;
        return response()->json(['data' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
