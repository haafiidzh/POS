<?php

namespace Modules\Front\Http\Controllers\Front;

use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Common\Models\Page;
use Modules\Common\Models\Post;

class MainController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('front::pages.index');
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function about()
    {
        return view('front::pages.about-us');
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function contact()
    {
        return view('front::pages.contact-us');
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function faq()
    {
        return view('front::pages.faq');
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function coupon()
    {
        return view('front::pages.coupon');
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function paymentMethod(Request $request)
    {
        $page = Page::whereSlug('metode-pembayaran')->firstOrFail();
        return view('front::pages.page', [
            'page' => $page,
        ]);
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function termsAndConditions(Request $request)
    {
        $page = Page::whereSlug('syarat-ketentuan')->firstOrFail();
        return view('front::pages.page', [
            'page' => $page,
        ]);
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function privacyPolicy(Request $request)
    {
        $page = Page::whereSlug('kebijakan-privasi')->firstOrFail();
        return view('front::pages.page', [
            'page' => $page,
        ]);
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function blog()
    {
        return view('front::pages.blog');
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function showBlog(Post $post)
    {
        return view('front::pages.show-blog', [
            'post' => $post,
        ]);
    }
}
