<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDriverRequest;
use App\Http\Requests\UpdateDriverRequest;
use App\Models\Driver;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\RedirectResponse;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('driver.index', ['drivers' => Driver::all()->sortBy('first_name')]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('driver.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDriverRequest $request): RedirectResponse
    {
        $driver = new Driver($request->validated());
        $driver->save();

        return Redirect::route('drivers.index')->with('status', 'created');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Driver $driver): View
    {
        return view('driver.edit', ['driver' => $driver]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDriverRequest $request, Driver $driver): RedirectResponse
    {
        $driver->update($request->validated());

        return Redirect::back()->with('status', 'updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Driver $driver): RedirectResponse
    {
        $driver->delete();

        return Redirect::route('drivers.index')->with('status', 'deleted');
    }
}
