<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Requests\UpdateInvoiceRequest;
use App\Models\Driver;
use App\Models\Invoice;
use App\Models\Work;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $drivers = Driver::all()->sortBy('first_name');

        if ($request->get('driver')) {
            $driver = Driver::with('invoices')->find($request->get('driver'));
            $invoices = $driver->invoices->sortByDesc('number');
        } else {
            $invoices = Invoice::all()->sortByDesc('number');

        }


        return view('invoice.index', ['invoices' => $invoices, 'drivers' => $drivers]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Driver $driver)
    {
        $works = $driver->works()
            ->with('theLoad')
            ->whereDoesntHave('invoice')
            ->get()
            ->sortByDesc(fn ($query) => $query->theLoad->pickup_datetime);

        $invoiceNo = 'ITO-' . time() . PHP_EOL . PHP_EOL;
        $billedTo = 'Billed to:' . PHP_EOL . $driver->fullName() . PHP_EOL . '+1 ' . $driver->phone;

        return view('invoice.create', [
            'invoice' => new Invoice([
                'number' => $invoiceNo,
            ]),
            'works' => $works,
            'driver' => $driver,
            'invoiceHeader' => 'Invoice No: ' . $invoiceNo . $billedTo,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInvoiceRequest $request)
    {
        $validated = $request->validated();
        $workIds = $validated['work_ids'];
        unset($validated['work_ids']);
        $invoice = new Invoice($validated);

        if ($invoice->save()) {
            /** @var Work $work */
            foreach (Work::find($workIds) as $work) {
                $work->invoice()->associate($invoice)->save();
            }
        }

        return Redirect::route('invoices.index')->with('flash', ['status' => 'success', 'text' => 'Invoice generated.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoices)
    {
        //
    }
}
