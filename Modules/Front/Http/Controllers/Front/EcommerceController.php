<?php

namespace Modules\Front\Http\Controllers\Front;

use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class EcommerceController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function cart()
    {
        return view('front::pages.cart');
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function checkout(Request $request)
    {
        return view('front::pages.checkout');
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function successPayment(Request $request)
    {
        try {
            return view('front::pages.payment-done', [
                'status' => 'success',
            ]);
        } catch (Exception $exception) {
            return redirect()->route('front.cart')->with('warning', 'Oops! Proses checkout gagal, karena telah melebihi batas waktu checkout yang telah ditentukan.');
        }
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function failedPayment(Request $request)
    {
        try {
            return view('front::pages.payment-done', [
                'status' => 'failed',
            ]);
        } catch (Exception $exception) {
            return redirect()->route('front.cart')->with('warning', 'Oops! Proses checkout gagal, karena telah melebihi batas waktu checkout yang telah ditentukan.');
        }
    }
}
