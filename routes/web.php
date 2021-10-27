<?php

use App\Http\Controllers\AppointmentsController;
use App\Http\Controllers\BreedsController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PetsController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\SettingsController;
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

Auth::routes();

Route::get('/', [PublicController::class, 'index'])->name('public');

Route::prefix('groomer')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::post('/get-pets', [CustomersController::class, 'getPetsOptions'])->name('getPetsOptions');
    
    Route::prefix('pets')->name('pets.')->group(function () {
        Route::get('/', [PetsController::class, 'index'])->name('index');
        Route::get('/new', [PetsController::class, 'create'])->name('create');
        Route::get('/{pet}/edit', [PetsController::class, 'edit'])->name('edit');
        Route::get('/{pet}/appointments', [PetsController::class, 'appointments'])->name('appointments');
        Route::get('/{pet}/appointment', [PetsController::class, 'appointment'])->name('appointment');
    });
    
    Route::prefix('customers')->name('customers.')->group(function () {
        Route::get('/', [CustomersController::class, 'index'])->name('index');
        Route::get('/new', [CustomersController::class, 'create'])->name('create');
        Route::get('/{customer}/edit', [CustomersController::class, 'edit'])->name('edit');
        Route::get('/{customer}/appointments', [CustomersController::class, 'appointments'])->name('appointments');
        Route::get('/{customer}/appointment', [CustomersController::class, 'appointment'])->name('appointment');

        Route::prefix('pets')->name('pets.')->group(function () {
            Route::post('/attach', [CustomersController::class, 'attachPet'])->name('attach');
            Route::post('/detach', [CustomersController::class, 'detachPet'])->name('detach');
        });
    });
    
    Route::prefix('appointments')->name('appointments.')->group(function () {
        Route::post('/store', [AppointmentsController::class, 'store'])->name('store');
        Route::put('/update', [AppointmentsController::class, 'update'])->name('update');
        Route::get('/{appointment}/edit', [AppointmentsController::class, 'edit'])->name('edit');
    });
    
    Route::prefix('settings')->name('settings.')->group(function () {
        Route::get('/', [SettingsController::class, 'breeds'])->name('breeds');
    });
});