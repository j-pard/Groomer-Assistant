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
    
    Route::prefix('pets')->group(function () {
        Route::get('/', [PetsController::class, 'index'])->name('pets');
        Route::get('/new', [PetsController::class, 'create'])->name('newPet');
        Route::post('/store', [PetsController::class, 'store'])->name('storePet');
        Route::get('/{pet}/edit', [PetsController::class, 'edit'])->name('editPet');
        Route::put('/update', [PetsController::class, 'update'])->name('updatePet');
    });
    
    Route::prefix('customers')->group(function () {
        Route::get('/', [CustomersController::class, 'index'])->name('customers');
        Route::get('/new', [CustomersController::class, 'create'])->name('newCustomer');
        Route::post('/store', [CustomersController::class, 'store'])->name('storeCustomer');
        Route::get('/{customer}/edit', [CustomersController::class, 'edit'])->name('editCustomer');
        Route::put('/update', [CustomersController::class, 'update'])->name('updateCustomer');
        Route::post('/attach', [CustomersController::class, 'attachPet'])->name('attachPet');
    });
    
    Route::prefix('appointments')->group(function () {
        Route::post('/store', [AppointmentsController::class, 'store'])->name('storeAppointment');
        Route::put('/update', [AppointmentsController::class, 'update'])->name('updateAppointment');
    });
    
    Route::prefix('settings')->group(function () {
        Route::get('/', [SettingsController::class, 'index'])->name('settings');
        Route::post('/breed', [BreedsController::class, 'get'])->name('getBreed');
        Route::post('/breed/update', [BreedsController::class, 'update'])->name('updateBreed');
    });
});