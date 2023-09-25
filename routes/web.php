<?php

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
    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/migrate', [MigrationController::class, 'migrate'])->name('db.migrate');

    Route::get('/loads', [LoadController::class, 'list'])->name('load.list');
    Route::get('/loads/create', [LoadController::class, 'create'])->name('load.create');
    Route::get('/loads/{load}', [LoadController::class, 'edit'])->name('load.edit');

    Route::post('/loads', [LoadController::class, 'store'])->name('load.store');
    Route::patch('/loads/{load}', [LoadController::class, 'update'])->name('load.update');
    Route::delete('/loads/{load}', [LoadController::class, 'destroy'])->name('load.delete');
});

require __DIR__.'/auth.php';
