<?php

namespace Modules\Administrator\Http\Controllers;

use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function transaction()
    {
        return view('administrator::pages.report.transaction');
    }
    public function index()
    {
        return view('administrator::pages.report.index');
    }
}