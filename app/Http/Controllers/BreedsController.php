<?php

namespace App\Http\Controllers;

use App\Models\Breed;
use Illuminate\Http\Request;

class BreedsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Return specified breed
     *
     * @param Request $request
     * @return Breed
     */
    public function get(Request $request)
    {
        return Breed::find($request->breed);
    }

    /**
     * Update specified Breed
     *
     * @param Request $request
     * @return Response
     */
    public function update(Request $request)
    {
        Breed::find($request->id)->update([
            'breed' => $request->breed,
            'size' => $request->size,
        ]);

        return response()->json(['success' => 'success'], 200);
    }
}
