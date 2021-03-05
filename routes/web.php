<?php

use App\Http\Controllers\CustomersController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PetsController;
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

Route::get('/', [HomeController::class, 'index'])->name('home');

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
});