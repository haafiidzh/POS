<?php

namespace Modules\Administrator\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Routing\Controller;
use Modules\Common\Models\Product;

class HistoryRetributionController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('administrator::pages.history-retribution.index');
    }

    
}
