<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Modules\Common\Models\HistoryRetribution;
use Illuminate\Support\Facades\Log;


class RetributionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $partnerId = $request->input('partner_id');
        $search = $request->input('search');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Jika start_date dan end_date tidak ada, gunakan bulan berjalan
        if (!$startDate || !$endDate) {
            $startDate = Carbon::now()->startOfMonth()->format('Y-m-d');
            $endDate = Carbon::now()->endOfMonth()->format('Y-m-d');
        }

        // Query untuk mengambil data dengan pagination
        $historyRetributions = HistoryRetribution::with('partner')
            ->where('partner_id', $partnerId)
            ->whereBetween('payment_date', [$startDate, $endDate])
            ->when($search, function ($query, $search) {
                return $query->whereHas('partner', function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%');
                });
            })
            ->paginate(10);

        // Kembalikan pesan jika tidak ada data
        if ($historyRetributions->isEmpty()) {
            return response()->json([
                'message' => 'Tidak ada data retribusi untuk periode ini.',
            ], 404);
        }

        return response()->json($historyRetributions);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**tab
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Log::info($request->all());
        // Log data request untuk diagnosis
        // Validasi data yang dikirim oleh user
        $validatedData = $request->validate([
            'partner_id' => 'required|exists:partners,id',
            'nominal'    => 'required|numeric|min:0',
            'days'       => 'required|integer|min:1', // Pastikan days adalah integer
        ]);


        // Ambil pembayaran sebelumnya berdasarkan partner_id
        $previousPayment = HistoryRetribution::where('partner_id', $validatedData['partner_id'])
            ->orderBy('end_date', 'desc')
            ->first();

        // Hitung start_date
        $startDate = $previousPayment ? Carbon::parse($previousPayment->end_date)->addDay() : Carbon::today();

        // Hitung end_date berdasarkan start_date dan jumlah hari yang diberikan
        $endDate = Carbon::parse($startDate)->addDays($validatedData['days'] - 1); // Kurangi 1 agar sesuai dengan hitungan hari

        // Ambil tanggal sekarang untuk payment_date
        $paymentDate = Carbon::now();

        // Simpan data ke tabel history_retributions
        $historyRetribution = HistoryRetribution::create([
            'partner_id'   => $validatedData['partner_id'],
            'start_date'   => $startDate->format('Y-m-d'),
            'end_date'     => $endDate->format('Y-m-d'),
            'payment_date' => $paymentDate->format('Y-m-d'),
            'nominal'      => $validatedData['nominal'],
        ]);

        // Kembalikan respon sukses
        return response()->json([
            'message' => 'History retribution saved successfully.',
            'data'    => $historyRetribution
        ], 201);
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
