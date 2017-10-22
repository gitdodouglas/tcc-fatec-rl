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

/*
|--------------------------------------------------------------------------
| Rotas do módulo de autenticação
|--------------------------------------------------------------------------
 */

/* Página inicial */
Route::get('/', 'HomeController@index')->name('home');

/* Login do usuário */
Route::get('login', 'LoginController@index');
Route::post('login', 'LoginController@login')->name('login');

/* Cadastro do usuário */
Route::get('cadastro', 'CadastroController@index');
Route::post('cadastro', 'CadastroController@create')->name('cadastro');

/* Validação do cadastro do usuário */
Route::get('valida', 'ValidaController@index');
Route::post('valida', 'ValidaController@verify')->name('valida');

/* Recuperação da senha do usuário */
Route::get('recupera', 'RecuperaController@index');
Route::post('recupera', 'RecuperaController@reset')->name('recupera');

/*-----------------------------------------------------------------------*/