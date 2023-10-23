<?php

namespace App\Http\Controllers;

use App\Models\Dog;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class DogsController extends Controller
{
    /**
     * Show dog creator interface.
     *
     * @return View
     */
    public function create(): View
    {
        return view('manager.dogs.create');
    }

    /**
     * Show dog details.
     *
     * @return View
     */
    public function show(Dog $dog): View
    {
        return view('manager.dogs.form', [
            'dog' => $dog,
        ]);
    }

    /**
     * Show dog timeline.
     *
     * @return View
     */
    public function timeline(Dog $dog): View
    {
        return view('manager.dogs.timeline', [
            'dog' => $dog,
        ]);
    }

    /**
     * Delete specified dog and redirect to dogs index.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function delete(Request $request): RedirectResponse
    {
        $request->validate([
            'dog_id' => 'required|int',
            'delete_owner' => 'nullable',
        ]);

        $dog = Dog::findOrFail($request['dog_id']);
        $owner = $dog->owner;

        DB::transaction(function () use ($dog, $owner, $request) {
            $dog->delete();

            if ((bool) Arr::get($request, 'delete_owner', false)) {
                $owner->delete();
            }
        });

        return redirect()->route('dogs.index');
    }
}
