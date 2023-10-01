<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDispatcherRequest;
use App\Http\Requests\UpdateDispatcherRequest;
use App\Models\Dispatcher;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\RedirectResponse;

class DispatcherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('dispatcher.index', ['dispatchers' => Dispatcher::all()->sortBy('name')]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('dispatcher.create', ['dispatcher' => new Dispatcher()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDispatcherRequest $request): RedirectResponse
    {
        $dispatcher = new Dispatcher($request->validated());
        $dispatcher->save();

        return Redirect::route('dispatchers.index')->with('status', 'created');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dispatcher $dispatcher): View
    {
        return view('dispatcher.edit', ['dispatcher' => $dispatcher]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDispatcherRequest $request, Dispatcher $dispatcher): RedirectResponse
    {
        $dispatcher->update($request->validated());

        return Redirect::back()->with('status', 'updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dispatcher $dispatcher): RedirectResponse
    {
        if ($dispatcher->loads()->count()) {
            return Redirect::back()->with('status', 'error');
        }

        $dispatcher->delete();

        return Redirect::route('dispatchers.index')->with('status', 'deleted');
    }
}
