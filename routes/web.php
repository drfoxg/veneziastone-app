<?php

use App\Http\Controllers\EmployerController;
use App\Http\Controllers\ParameterController;
use App\Http\Controllers\CartController;
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

Route::get('/welcome', function () {
    return view('welcome');
});

Route::resource('/parameters', ParameterController::class);
//Route::get('/parameters', [ParameterController::class, 'index'])->name('parameters.index');
//Route::resource('/', EmployerController::class)->middleware('global.cache:Employer');

Route::get('/', [EmployerController::class, 'index'])->name('index')->middleware('global.cache:Employer');
Route::post('/', [EmployerController::class, 'store'])->name('store');
Route::get('/create', [EmployerController::class, 'create'])->name('create');
Route::get('/{id}', [EmployerController::class, 'show'])->name('show');
Route::delete('/{employer}', [EmployerController::class, 'destroy'])->name('destroy');


Route::get('/cart', [CartController::class, 'makeOrder']);
