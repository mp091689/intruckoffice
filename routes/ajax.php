<?php

use App\Http\Controllers\Ajax\AddressController;
use Illuminate\Support\Facades\Route;

Route::middleware([])->group(function () {
    Route::get('/address/zip/{zip}', [AddressController::class, 'index'])->name('address.zip.zip');
});
