<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MotoboyController;
use App\Http\Controllers\MotoboyDashboardController;
use App\Http\Controllers\PedidoController;
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

Route::controller(UserController::class)->group(function () {
    Route::get('/user/cadastro', 'create')->name('user.create');
    Route::post('/user', 'store')->name('user.store');
    Route::get('/user/login', 'login')->name('user.login');
    Route::post('/user/auth', 'auth')->name('user.auth');
    Route::get('/user/logout', 'logout')->name('user.logout');
    Route::get('/user/edit', 'edit')->middleware('user.auth')->name('user.edit');
    Route::put('/user', 'update')->name('user.update');
    Route::post('/user/search', 'search')->name('user.search');
    Route::post('/user/addr', 'GetAdrr')->name('user.addr');
});

Route::controller(MotoboyController::class)->group(function () {
    Route::get('/motoboy/cadastro', 'create')->name('motoboy.create');
    Route::post('/motoboy', 'store')->name('motoboy.store');
    Route::get('/motoboy/login', 'login')->name('motoboy.login');
    Route::post('/motoboy/auth', 'auth')->name('motoboy.auth');
});

Route::controller(UserDashboardController::class)->group(function () {
    Route::get('/', 'home')->middleware('user.auth')->name('user.dashboard');
});

Route::controller(MotoboyDashboardController::class)->group(function () {
    Route::get('/motoboy/dashboard', 'home')->middleware('motoboy.auth')->name('motoboy.dashboard');
});

Route::controller(PedidoController::class)->group(function () {
    Route::get('/pedido/create', 'create')->middleware('user.auth')->name('pedido.create');
    Route::post('/pedido', 'store')->name('pedido.store');
    Route::get('/pedido/enviado/{id}', 'IndexEnviado')->name('pedido.enviado');
    Route::get('/pedido/recebido/{id}', 'IndexRecebido')->name('pedido.recebido');
    Route::get('/pedido/entrega/{id}', 'aceitar')->name('pedido.aceitar');
    Route::get('/pedido/concluir/{id}', 'concluir')->name('pedido.concluir');
});
