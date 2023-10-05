<?php

namespace App\Http\Controllers;

use App\Models\Dispatcher;
use App\Models\Load;
use Illuminate\View\View;

class InvoicesController extends Controller
{
    public function index(): View
    {
        $loads = Load::with('driver', 'driver2')
            ->get()
            ->where('status', '!=', Load::STATUS_CANCELED);

        foreach ($loads as $load) {

        }

        return view('invoices');
    }
}
