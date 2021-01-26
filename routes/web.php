<?php

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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('pets')->group(function () {
    Route::get('/', [App\Http\Controllers\PetsController::class, 'index'])->name('pets');
    Route::get('/new', [App\Http\Controllers\PetsController::class, 'create'])->name('newPet');
    Route::post('/store', [App\Http\Controllers\PetsController::class, 'store'])->name('storeNewPet');
    Route::get('/edit', [App\Http\Controllers\PetsController::class, 'edit'])->name('editPet');
    Route::put('/update', [App\Http\Controllers\PetsController::class, 'update'])->name('updatePet');
});