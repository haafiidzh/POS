<?php

namespace Modules\Administrator\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Routing\Controller;
use Modules\Common\Models\Retribution;

class RetributionController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('administrator::pages.retribution.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('administrator::pages.retribution.create');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $retribution = Retribution::findOrFail($id);
        return view('administrator::pages.retribution.edit', [
            'retribution' => $retribution,
        ]);
    }
}
