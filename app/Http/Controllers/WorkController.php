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

        return Redirect::route('loads.index')
            ->withFragment('load-' . $work->load_id)
            ->with('flash', ['status' => 'success', 'text' => 'Work created.']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Work $work)
    {
        if ($work->invoice()->count()) {
            return Redirect::route('loads.index')->with('flash', [
                'status' => 'warning',
                'text' => 'Work has posted invoice. Work can\'t be edited.' ,
            ]);
        }

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
        if ($work->invoice()->count()) {
            return Redirect::back()->with('flash', [
                'status' => 'fail',
                'text' => 'Work has posted invoice. Work can\'t be updated.' ,
            ]);
        }

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
        if ($work->invoice()->count()) {
            return Redirect::back()->with('flash', [
                'status' => 'fail',
                'text' => 'Work has related invoice. Work can\'t be deleted.' ,
            ]);
        }

        $work->delete();

        return Redirect::route('loads.index')
            ->withFragment('load-' . $work->load_id)
            ->with('flash', ['status' => 'success', 'text' => 'Work deleted.']);
    }
}
