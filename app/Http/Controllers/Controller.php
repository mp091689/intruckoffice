<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Config;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function index()
    {
        dd($_ENV);
        return view('welcome', [
            'DB_CONNECTION' => Config::get('DB_CONNECTION'),
            'DB_HOST' => Config::get('DB_HOST'),
            'DB_PORT' => Config::get('DB_PORT'),
            'DB_USERNAME' => Config::get('DB_USERNAME'),
            'DB_PASSWORD' => Config::get('DB_PASSWORD'),
        ]);
    }
}
