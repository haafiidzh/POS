<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Common\Models\Transaction;
use Carbon\Carbon;
use Modules\Common\Models\TransactionDetail;
use Illuminate\Support\Facades\Log;


class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function index(Request $request)
    {
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');
        $search = $request->query('search', ''); // Default to empty string if not provided
        $perPage = $request->query('per_page', 10); // Default 10 items per page

        if (!$startDate || !$endDate) {
            $startDate = Carbon::today()->toDateString(); // Tanggal hari ini
            $endDate = Carbon::tomorrow()->toDateString();   // Tanggal hari ini
        }

        $sales = Transaction::query();

        $sales->whereBetween('transaction_date', [$startDate, $endDate]);

        // Jika ada query pencarian, tambahkan ke query
        if (!empty($search)) {
            // Search by partner_id or transaction_date (modify as needed)
            $sales->where(function ($query) use ($search) {
                $query->where('partner_id', '=', $search)
                    ->orWhere('transaction_date', '=', $search);
            });
        }

        $sales = $sales->paginate($perPage);

        return response()->json($sales);
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
    public function show($id)
    {
        // Ambil semua transaction details yang berkaitan dengan transaction_id dan muat relasi product
        $data = TransactionDetail::where('transaction_id', $id)
            ->with('product')  // Memuat relasi product
            ->get();

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
