<?php

namespace App\Http\Controllers;

use App\Models\Load;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class LoadController extends Controller
{
    public function list()
    {
        return view('load.list', ['loads' => Load::all()->sortByDesc('pickup_datetime')]);
    }

    public function create()
    {
        return view('load.create');
    }

    public function edit(Load $load): View
    {
        return view('load.edit', [
            'load' => $load,
        ]);
    }

    public function store(): RedirectResponse
    {
        $attributes = \request()->validate([
            'price' => ['required', 'numeric'],
            'percentage' => ['required', 'integer', 'max:100', 'min:0'],
            'distance' => ['required', 'numeric'],
            'pickup_address' => ['required', 'string', 'min:5'],
            'pickup_datetime' => ['required', 'date'],
            'dropoff_address' => ['required', 'string', 'min:5'],
            'dropoff_datetime' => ['required', 'date', 'min:5'],
            'description' => ['string'],
        ]);

        Load::create($attributes);

        return \redirect()->route('load.list')->with('status', 'success');
    }

    public function update(Load $load)
    {
        $attributes = \request()->validate([
            'price' => ['required', 'numeric'],
            'percentage' => ['required', 'integer', 'max:100', 'min:0'],
            'distance' => ['required', 'numeric'],
            'pickup_address' => ['required', 'string', 'min:5'],
            'pickup_datetime' => ['required', 'date'],
            'dropoff_address' => ['required', 'string', 'min:5'],
            'dropoff_datetime' => ['required', 'date', 'min:5'],
            'description' => ['string'],
        ]);

        $load->update($attributes);

        return back()->with('status', 'success');
    }

    public function destroy(Load $load): RedirectResponse
    {
        $load->delete();

        return \redirect()->route('load.list')->with('status', 'success');
    }
}
