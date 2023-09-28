<?php

use App\Http\Controllers\EmployerController;
use App\Http\Controllers\ParameterController;
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

/*
Route::get('/', function () {
    return view('employer');
});
*/


Route::resource('/', EmployerController::class);
Route::resource('/parameters', ParameterController::class);
