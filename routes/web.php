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

/**
 * Rota responsável pela Página Inicial
 */
Route::get('/', 'HomeController@index')->name('home');

/**
 * Rota responsável pelo login
 */
Route::post('/login', 'LoginController@index')->name('login');

/**
 * Rota responsável pelo cadastro
 */
Route::get('/cadastro', 'CadastroController@index');
Route::post('/cadastro', 'CadastroController@store')->name('cadastro');

/**
 * Rota responsável pela validação do cadastro
 */
Route::post('/valida', 'ValidaController@index')->name('valida');

/**
 * Rota responsável pela recuperação da senha
 */
Route::post('/recupera', 'RecuperaController@index')->name('recupera');