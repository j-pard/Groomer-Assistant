<?php

use App\Http\Controllers\DogsController;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes([
    'register' => false,
    'reset' => false,
]);

Route::middleware([Authenticate::class])->group(function () {
    Route::get('', [HomeController::class, 'dashboard'])->name('home');

    Route::prefix('dogs')->name('dogs.')->group(function () {
        Route::view('', 'manager.dogs.table')->name('index');
        Route::view('create', 'manager.dogs.create')->name('create');
        Route::post('delete', [DogsController::class, 'delete'])->name('delete');
        Route::prefix('{dog}')->group(function () {
            Route::get('', [DogsController::class, 'show'])->name('show');
            Route::get('timeline', [DogsController::class, 'timeline'])->name('timeline');
            Route::get('gallery', [DogsController::class, 'gallery'])->name('gallery');
        });
    });

    Route::prefix('appointments')->name('appointments.')->group(function () {
        Route::view('', 'manager.appts.table')->name('index');
    });

    Route::prefix('accounting')->name('accounting.')->group(function () {
        Route::view('', 'manager.accounting.index')->name('index');
    });
});
