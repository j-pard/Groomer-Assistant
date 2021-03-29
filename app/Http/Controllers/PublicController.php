<?php

namespace App\Http\Controllers;


class PublicController extends Controller
{
    /**
     * Show public index.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('frontend.index');
    }

}
