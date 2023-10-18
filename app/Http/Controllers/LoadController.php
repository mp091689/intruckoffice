<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLoadRequest;
use App\Http\Requests\UpdateLoadRequest;
use App\Models\Dispatcher;
use App\Models\Driver;
use App\Models\Load;
use App\Models\LoadStatus;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class LoadController extends Controller
{
    public function index(): View
    {
        $loads = Load::with('works')
            ->get()
            ->sortByDesc('pickup_datetime');

        return view('load.index', ['loads' => $loads]);
    }

    public function create(): View
    {
        return view('load.create', [
            'load' => new Load(),
            'dispatchers' => Dispatcher::all()->sortBy('name'),
        ]);
    }

    public function store(StoreLoadRequest $request): RedirectResponse
    {
        $load = new Load($request->validated());
        $load->save();

        return Redirect::route('loads.index')->with('flash', ['status' => 'success', 'text' => 'Load created.']);
    }

    public function edit(Load $load)
    {
        if ($load->invoices()->count()) {
            return Redirect::route('loads.index')->with('flash', [
                'status' => 'warning',
                'text' => 'Load has posted invoices. Load can\'t be edited.' ,
            ]);
        }

        return view('load.edit', [
            'load' => $load,
            'drivers' => Driver::all()->sortBy('first_name'),
            'dispatchers' => Dispatcher::all()->sortBy('name'),
        ]);
    }

    public function update(UpdateLoadRequest $request, Load $load): RedirectResponse
    {
        if ($load->invoices()->count()) {
            return Redirect::back()->with('flash', [
                'status' => 'fail',
                'text' => 'Load has posted invoices. Load can\'t be updated.' ,
            ]);
        }

        $load->update($request->validated());

        return Redirect::back()->with('flash', ['status' => 'success', 'text' => 'Load data updated.']);
    }

    public function destroy(Load $load): RedirectResponse
    {
        if ($load->works()->count()) {
            return Redirect::back()->with('flash', [
                'status' => 'fail',
                'text' => 'Load has related works. Load can\'t be deleted.' ,
            ]);
        }

        $load->delete();

        return Redirect::route('loads.index')->with('flash', ['status' => 'success', 'text' => 'Load deleted.']);
    }
}
