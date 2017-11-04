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

/* Rota de teste - Requer autenticação para acessar */
Route::get('/app', 'AppController@index');

/* Página inicial */
Route::get('/', 'HomeController@index')->name('home');

/* Login do usuário */
Route::get('login', 'LoginController@index');
Route::post('login', 'LoginController@login')->name('login');

/* Logout do usuário */
Route::get('logout', 'LogoutController@index');
Route::post('logout', 'LogoutController@logout')->name('logout');

/* Cadastro do usuário */
Route::get('cadastro', 'CadastroController@index');
Route::post('cadastro', 'CadastroController@create')->name('cadastro');

/* Validação do cadastro do usuário */
Route::get('altera', 'AlteraController@index');
Route::post('altera', 'AlteraController@verify')->name('altera');

/* Recuperação da senha do usuário */
Route::get('esqueci', 'RecuperaController@index');
Route::post('esqueci', 'RecuperaController@reset')->name('esqueci');

/*-----------------------------------------------------------------------*/