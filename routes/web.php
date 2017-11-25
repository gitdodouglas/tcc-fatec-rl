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



/*
|--------------------------------------------------------------------------
| Rotas do módulo de aplicação
|--------------------------------------------------------------------------
 */

/* Debug */
Route::get('/debug', 'QuestaoController@check');

/* Níveis */
Route::get('/principal', 'NivelController@index');
Route::post('/principal', 'NivelController@level');

/* Tópicos */
Route::get('/topicos', 'TopicoController@index');
Route::post('/topicos', 'TopicoController@topic');

/* Conteúdo */
Route::get('/conteudo', 'ConteudoController@index');
Route::post('/conteudo', 'ConteudoController@content');

/* Questões */
Route::get('/questoes', 'QuestaoController@index');
Route::post('/questoes', 'QuestaoController@question');
Route::get('/corrige', 'QuestaoController@index');
Route::post('/corrige', 'QuestaoController@check');

/*-----------------------------------------------------------------------*/