<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mockery\Exception;

class LoginController extends Controller
{
    /**
     * Função que redireciona para a url correta.
     * Utilizada quando a rota é acessada por um método GET.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function index()
    {
        return redirect('/#/login');
    }

    /**
     * Função que realiza o login do usuário.
     *
     * @param Request $request
     * @return array
     */
    public function login(Request $request)
    {
        try {
            /* Realiza a tentativa de login usando o e-mail e senha informados */
            if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
                return [
                    'codigo' => '0',
                    'objeto' => Auth::user(),
                    'mensagem' => 'Usuário autenticado com sucesso!',
                ];
            } else {
                return [
                    'codigo' => '1',
                    'objeto' => null,
                    'mensagem' => 'Não foi possível autenticar o usuário.',
                ];
            }
        } catch (Exception $exception) {
            return [
                'codigo' => '1',
                'objeto' => null,
                'mensagem' => $exception->getMessage(),
            ];
        }
    }
}

