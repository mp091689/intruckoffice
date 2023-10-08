<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreWorkRequest;
use App\Http\Requests\UpdateWorkRequest;
use App\Models\Driver;
use App\Models\Load;
use App\Models\Work;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class WorkController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): view
    {
        $work = new Work(['load_id' => $request->get('load')]);
        $work->load(['theLoad']);

        return view('work.create', [
            'work' => $work,
            'drivers' => Driver::all()->sortBy('first_name'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreWorkRequest $request): RedirectResponse
    {
        $work = new Work($request->validated());
        $work->save();

        return Redirect::route('loads.index')->with('flash', ['status' => 'success', 'text' => 'Work created.']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Work $work): View
    {
        return view('work.edit', [
            'work' => $work,
            'drivers' => Driver::all()->sortBy('first_name'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWorkRequest $request, Work $work): RedirectResponse
    {
        $flash = ['status' => 'success', 'text' => 'Work data updated.'];

        if (!$work->update($request->validated())) {
            $flash = ['status' => 'fail', 'text' => 'Work wasn\'t updated.'];
        }

        return Redirect::back()->with('flash', $flash);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Work $work): RedirectResponse
    {
        // cant be deleted if invoiced
        $work->delete();

        return Redirect::route('loads.index')->with('flash', ['status' => 'success', 'text' => 'Work deleted.']);
    }
}
