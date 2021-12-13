<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('estados', 'App\Http\Controllers\estadoController@index');
Route::get('categorias', 'App\Http\Controllers\categoriaController@index');

Route::resource('clientes', 'App\Http\Controllers\clienteController', [
    'only' => ['index', 'show', 'store', 'update', 'destroy'],
]);
