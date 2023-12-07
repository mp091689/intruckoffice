<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoadStatusRequest;
use App\Http\Requests\StoreLoadRequest;
use App\Http\Requests\UpdateLoadRequest;
use App\Models\Dispatcher;
use App\Models\Driver;
use App\Models\Load;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Str;

class LoadController extends Controller
{
    public function index(): View
    {
        $loads = Load::with('works')
            ->with('zipCodes')
            ->get()
            ->sortByDesc('id');

        return view('load.index', [
            'loads' => $loads,
            'drivers' => Driver::all(),
        ]);
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
        $validated = $request->validated();

        $load = new Load($validated);
        $load->actual_price = $load->estimated_price;
        $load->actual_distance = $load->estimated_distance;
        $load->save();

        $load->zipCodes()->createMany($validated['zipCodes'], $validated['zipCodes']);

        return Redirect::route('loads.index')->with('flash', ['status' => 'success', 'text' => 'Load created.']);
    }

    public function edit(Load $load)
    {
        if ($load->invoices()->count()) {
            return Redirect::route('loads.index')->with('flash', [
                'status' => 'warning',
                'text' => 'Load has posted invoices. Load can\'t be edited.',
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
                'text' => 'Load has posted invoices. Load can\'t be updated.',
            ]);
        }

        $validated = $request->validated();

        $load->fill($validated);
        $load->save();

        $load->zipCodes()->detach();
        $load->zipCodes()->createMany($validated['zipCodes'], $validated['zipCodes']);

        return Redirect::route('loads.index')
            ->withFragment('load-' . $load->id)
            ->with('flash', ['status' => 'success', 'text' => 'Load data updated.']);
    }

    public function destroy(Load $load): RedirectResponse
    {
        if ($load->works()->count()) {
            return Redirect::back()->with('flash', [
                'status' => 'fail',
                'text' => 'Load has related works. Load can\'t be deleted.',
            ]);
        }

        $load->zipCodes()->detach();
        $load->delete();

        return Redirect::route('loads.index')->with('flash', ['status' => 'success', 'text' => 'Load deleted.']);
    }

    public function quickStatusChange(LoadStatusRequest $request, Load $load): RedirectResponse
    {
        $load->fill($request->validated());
        $load->save();

        $statusTitle = Str::of($load->status->value)->snake()->replace('_', ' ')->title();

        return Redirect::route('loads.index')
            ->with('flash', [
                'status' => 'success',
                'text' => 'Load status changed to ' . $statusTitle . '.',
            ]);
    }
}
