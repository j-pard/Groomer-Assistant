<?php

use App\Http\Controllers\AccountingController;
use App\Http\Controllers\AppointmentsController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\DogsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PetsController;
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

Auth::routes(['register' => false]);

Route::middleware([Authenticate::class])->group(function () {
    Route::get('', [HomeController::class, 'index'])->name('home');
    
    Route::prefix('dogs')->name('dogs.')->group(function () {
        Route::view('', 'manager.dogs.table')->name('index');
        Route::get('create', [DogsController::class, 'create'])->name('create');
        Route::prefix('{dog}')->group(function () {
            Route::get('', [DogsController::class, 'show'])->name('show');
            Route::get('timeline', [DogsController::class, 'timeline'])->name('timeline');
        });
    });

    Route::prefix('pets')->name('pets.')->group(function () {
        Route::get('', [PetsController::class, 'index'])->name('index');
        Route::get('new', [PetsController::class, 'create'])->name('create');
        Route::prefix('{pet}')->group(function () {
            Route::get('edit', [PetsController::class, 'edit'])->name('edit');
            Route::get('appointments', [PetsController::class, 'appointments'])->name('appointments');
            Route::get('appointment', [PetsController::class, 'appointment'])->name('appointment');
            Route::get('gallery', [PetsController::class, 'gallery'])->name('gallery');
        });
        
    });
    
    Route::prefix('customers')->name('customers.')->group(function () {
        Route::get('', [CustomersController::class, 'index'])->name('index');
        Route::get('new', [CustomersController::class, 'create'])->name('create');
        Route::prefix('{customer}')->group(function () {
            Route::get('edit', [CustomersController::class, 'edit'])->name('edit');
            Route::get('appointments', [CustomersController::class, 'appointments'])->name('appointments');
            Route::get('appointment', [CustomersController::class, 'appointment'])->name('appointment');
        });
    });
    
    Route::prefix('appointments')->name('appointments.')->group(function () {
        Route::get('{appointment}/edit', [AppointmentsController::class, 'edit'])->name('edit');
    });

    Route::prefix('accounting')->name('accounting.')->group(function () {
        Route::get('', [AccountingController::class, 'index'])->name('index');
    });
});
