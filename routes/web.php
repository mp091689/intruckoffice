<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DispatcherController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\LoadController;
use App\Http\Controllers\MigrationController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/invoices/generate', [InvoicesController::class, 'index'])->name('invoices.generate');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('loads', LoadController::class);
    Route::patch('loads/status/{load}', [LoadController::class, 'updateStatus'])->name('loads.update.status');
    Route::resource('drivers', DriverController::class);
    Route::resource('dispatchers', DispatcherController::class);
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::post('/migrate', [MigrationController::class, 'migrate'])->name('db.migrate');
});

require __DIR__.'/auth.php';
