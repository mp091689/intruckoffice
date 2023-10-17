<?php

namespace App\Http\Controllers;

use App\Models\Dispatcher;
use App\Models\Load;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        // from PHP documentations
        $logFile = file(storage_path('logs/laravel.log'));
        $logBody = '';
        // Loop through an array, show HTML source as HTML source; and line numbers too.
        foreach ($logFile as $line) {
            $logBody .= $line . PHP_EOL;
        }

        $months = Load::all()->groupBy(function ($row) {
            return $row->pickup_datetime->format('m');
        });

        return view('dashboard', [
            'dispatchers' => Dispatcher::all()->sortBy('name'),
            'groupedLoads' => $months,
            'logs' => $logBody,
        ]);
    }
}
