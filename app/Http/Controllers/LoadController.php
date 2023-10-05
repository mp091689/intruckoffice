<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLoadRequest;
use App\Http\Requests\UpdateLoadRequest;
use App\Http\Requests\UpdateStatusLoadRequest;
use App\Models\Dispatcher;
use App\Models\Driver;
use App\Models\Load;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class LoadController extends Controller
{
    public function index(): View
    {
        $loads = Load::with('driver')
            ->get()
            ->sortByDesc('pickup_datetime')
            ->sortBy(function (Load $load) {
                return match ($load->status) {
                    Load::STATUS_IN_PROGRESS => 1,
                    Load::STATUS_DONE => 2,
                    Load::STATUS_CANCELED => 3,
                };
            });

        return view('load.index', ['loads' => $loads]);
    }

    public function create(): View
    {
        return view('load.create', [
            'load' => new Load(),
            'drivers' => Driver::all()->sortBy('first_name'),
            'dispatchers' => Dispatcher::all()->sortBy('name'),
        ]);
    }

    public function store(StoreLoadRequest $request): RedirectResponse
    {
        $load = new Load($request->validated());
        $load->save();

        return Redirect::route('loads.index')->with('flash', ['status' => 'success', 'text' => 'Load created.']);
    }

    public function edit(Load $load): View
    {
        return view('load.edit', [
            'load' => $load,
            'drivers' => Driver::all()->sortBy('first_name'),
            'dispatchers' => Dispatcher::all()->sortBy('name'),
        ]);
    }

    public function update(UpdateLoadRequest $request, Load $load): RedirectResponse
    {
        $load->update($request->validated());

        return Redirect::back()->with('flash', ['status' => 'success', 'text' => 'Load data updated.']);
    }

    public function updateStatus(UpdateStatusLoadRequest $request, Load $load): RedirectResponse
    {
        $load->update($request->validated());

        return Redirect::back()->with('flash', ['status' => 'success', 'text' => 'Load status updated.']);
    }

    public function destroy(Load $load): RedirectResponse
    {
        $load->delete();

        return Redirect::route('loads.index')->with('flash', ['status' => 'success', 'text' => 'Load deleted.']);
    }
}
