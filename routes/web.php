<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MotoboyController;
use App\Http\Controllers\UserDashboardController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::controller(UserController::class)->group(function () {
    Route::get('/user/cadastro', 'create')->name('user.create');
    Route::post('/user', 'store')->name('user.store');
    Route::get('/user/login', 'login')->name('user.login');
    Route::post('/user/auth', 'auth')->name('user.auth');
});

Route::controller(MotoboyController::class)->group(function () {
    Route::get('/motoboy/cadastro', 'create')->name('motoboy.create');
    Route::post('/motoboy', 'store')->name('motoboy.store');
    Route::get('/motoboy/login', 'login')->name('motoboy.login');
    Route::post('/motoboy/auth', 'auth')->name('motoboy.auth');
});

Route::controller(UserDashboardController::class)->group(function () {
    Route::get('/user/dashboard', 'home')->middleware('basic.auth')->name('user.dashboard');
});
