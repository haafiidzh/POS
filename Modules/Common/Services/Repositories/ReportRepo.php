<?php

namespace Modules\Common\Services\Repositories;

use Modules\Common\Models\Transaction;

class ReportRepo
{
    public function dailyReport(object $request, $total = 10, $paginated = true)
    {
        $transactions = Transaction::query()
            ->with('partner:id,name')
            // ->where('partner_id', $request->id)
            ->selectRaw('DATE(transaction_date) as date, 
            SUM(total_amount) as total_sales,
            SUM(CASE WHEN payment_method = "qris" THEN total_amount ELSE 0 END) as total_qris,
            SUM(CASE WHEN payment_method = "cash" THEN total_amount ELSE 0 END) as total_cash')
            ->groupBy('date');

        if ($request->partner_id) {
            $transactions->where('partner_id', $request->partner_id);
        }

        if (isset($request->date_start) && isset($request->date_end)) {
            $transactions->whereBetween('transaction_date', [$request->date_start, $request->date_end]);
        }

        if (!$paginated) {
            return $transactions->orderBy('date', 'desc')->get();
        }

        return $transactions->orderBy('date', 'desc')->paginate($total);
    }
}
