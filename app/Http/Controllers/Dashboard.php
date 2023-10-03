<?php

namespace App\Http\Controllers;

use App\Models\Dispatcher;
use App\Models\Load;
use Illuminate\View\View;

class Dashboard extends Controller
{
    public function index(): View
    {
        $months = Load::all()
            ->groupBy(function ($row) {
                return $row->pickup_datetime->format('m');
            });

        return view('dashboard', [
            'dispatchers' => Dispatcher::all()->sortBy('name'),
            'groupedLoads' => $months,
        ]);
    }
}
