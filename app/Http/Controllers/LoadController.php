<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLoadRequest;
use App\Http\Requests\UpdateLoadRequest;
use App\Models\Load;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class LoadController extends Controller
{
    public function index(): View
    {
        return view('load.index', ['loads' => Load::all()->sortByDesc('pickup_datetime')]);
    }

    public function create(): View
    {
        return view('load.create');
    }

    public function store(StoreLoadRequest $request): RedirectResponse
    {
        $load = new Load($request->validated());
        $load->save();

        return Redirect::route('loads.index')->with('status', 'success');
    }

    public function edit(Load $load): View
    {
        return view('load.edit', ['load' => $load]);
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
