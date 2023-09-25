<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Artisan;

class MigrationController extends Controller
{
    public function migrate()
    {
        Artisan::call('migrate');

        return redirect()->back()->with('success', 'migration executed');
    }
}
