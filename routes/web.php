<?php

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

//Route::get('/', ['App\Http\Controllers\HomeController', 'index'])->name('home');

//Route::get('/switch', ['App\Http\Controllers\ToggleController', 'handle'])->name('switch');

/*
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
*/

Route::get('/', ['App\Http\Controllers\GpioController', 'index'])->name('index');

Route::middleware(['auth:sanctum', 'verified'])
    ->group( function(){
        Route::get('/dashboard', ['App\Http\Controllers\GpioController', 'index'])->name('dashboard');
        Route::post('/dashboard/operations', ['App\Http\Controllers\GpioController', 'create'])->name('operations');
        Route::post('/dashboard/create', ['App\Http\Controllers\GpioController', 'create'])->name('create');
        Route::post('/dashboard/update', ['App\Http\Controllers\GpioController', 'create'])->name('update');
        Route::post('/dashboard/store', ['App\Http\Controllers\GpioController', 'store'])->name('store');
        Route::delete('/dashboard/delete', ['App\Http\Controllers\GpioController', 'destroy'])->name('delete');
    });