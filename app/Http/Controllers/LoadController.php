<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLoadRequest;
use App\Http\Requests\UpdateLoadRequest;
use App\Models\Driver;
use App\Models\Load;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class LoadController extends Controller
{
    public function index(?Driver $driver): View
    {
        $title = 'Loads';
        $builder = Load::with('driver');

        if ($driver->exists) {
            $title = "Loads: $driver->fullName";
            $builder->where('driver_id', $driver->id)
                ->orWhere('driver2_id', $driver->id);
        }

        $loads = $builder->get()->sortByDesc('pickup_datetime');

        return view('load.index', ['loads' => $loads, 'title' => $title]);
    }

    public function create(): View
    {
        return view('load.create', [
            'load' => new Load(),
            'drivers' => Driver::all(),
        ]);
    }

    public function store(StoreLoadRequest $request): RedirectResponse
    {
        $load = new Load($request->validated());
        $load->save();

        return Redirect::route('loads.index')->with('status', 'success');
    }

    public function edit(Load $load): View
    {
        return view('load.edit', [
            'load' => $load,
            'drivers' => Driver::all(),
        ]);
    }

    public function update(UpdateLoadRequest $request, Load $load): RedirectResponse
    {
        $load->update($request->validated());

        return Redirect::back()->with('status', 'updated');
    }

    public function destroy(Load $load): RedirectResponse
    {
        $load->delete();

        return Redirect::route('loads.index')->with('status', 'deleted');
    }
}
