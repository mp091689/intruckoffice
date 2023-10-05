<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Artisan;

class MigrationController extends Controller
{
    public function migrate()
    {
        Artisan::call('migrate', ['--force' => true]);

        return redirect()->back()->with('flash', ['status' => 'success', 'text' => 'Migration executed.']);
    }
}
