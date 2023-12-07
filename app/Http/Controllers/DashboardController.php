<?php

namespace App\Http\Controllers;

use App\Models\Dispatcher;
use App\Models\Load;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $logs = '';
        $logPath = storage_path('logs/laravel.log');
        if (file_exists($logPath)) {
            $logFile = file($logPath);
            foreach ($logFile as $line) {
                $logs .= $line . PHP_EOL;
            }
        }

        $months = Load::with('zipCodes')
            ->has('zipCodes')
            ->get()
            ->groupBy(function (Load $load) {
                return $load->zipCodes->first()->pivot->datetime->format('W');
            });

        return view('dashboard', [
            'dispatchers' => Dispatcher::all()->sortBy('name'),
            'groupedLoads' => $months,
            'logs' => $logs,
        ]);
    }
}
