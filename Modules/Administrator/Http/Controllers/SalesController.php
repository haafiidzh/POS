<?php

namespace Modules\Administrator\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Common\Models\Transaction;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('administrator::pages.sales.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('administrator::pages.sales.create');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $transaction = Transaction::findOrFail($id);
        return view('administrator::pages.transaction.edit', [
            'transaction' => $transaction,
        ]);
    }
    
    public function show($id)
    {
        $transaction = Transaction::findOrFail($id);
        return view('administrator::pages.sales.detail', [
            'transaction' => $transaction,
        ]);
    }
}
