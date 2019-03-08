<?php

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

Route::get('/', function () {
    return view('welcome');
});

// Muestra el formulario para realizar una petición de transacción por web checkout a P2P
Route::get('/formulario', 'App\\PagosController@index');

// Muestra la lista de transacciones realizadas
Route::get('/transacciones', 'App\\PagosController@list');

// Muestra la confirmación de la transacción de P2P (retorno)
Route::get('/confirmacion/{id}', 'App\\PagosController@confirmacion');

// Realiza una solicitud de transacción a P2P
Route::post('/crearTransaccion', 'App\\PagosController@crearTransaccion');