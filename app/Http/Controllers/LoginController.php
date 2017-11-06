<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
        return redirect('/#!login');
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
            /* Verifica a entrada de dados */
            if ($request->json('email') == "" || $request->json('password') == "") {
                throw new \Exception('Todos os campos são de preenchimento obrigatório.');
            }

            /* Gera o token de validação da sessão */
            $token = hash('sha256', $request . microtime());

            /* Instancia o controller de usuário */
            $userController = new UserController;

            /* Verifica se o usuário existe */
            if ($user = $userController->query('email', $request->json('email'))) {

                /* Armazena o token em session */
                session()->put('$_TOKEN', $token);

                /* Armazena o e-mail em session */
                session()->put('$_EMAIL', $user->email);

                /* Verifica se o cadastro foi validado */
                if ($user->created_at == $user->updated_at && Hash::check($request->json('password'), $user->password)) {
                    return [
                        'codigo' => 'success',
                        'objeto' => [
                            'codigo_tipo' => 1,
                            'info' => $user->email,
                            'token' => $token,
                        ],
                        'mensagem' => 'Pedimos que altere a sua senha antes de efetuar o login.',
                    ];
                } else {
                    /* Realiza a tentativa de login usando o e-mail e senha informados */
                    if (Auth::attempt(['email' => $request->json('email'), 'password' => $request->json('password')])) {
                        return [
                            'codigo' => 'success',
                            'objeto' => [
                                'codigo_tipo' => '0',
                                'info' => Auth::user(),
                                'token' => $token,
                            ],
                            'mensagem' => null,
                        ];
                    } else {
                        throw new \Exception('E-mail ou senha inválidos.');
                    }
                }

            } else {
                throw new \Exception('E-mail ou senha inválidos.');
            }
        } catch (\Exception $exception) {
            return [
                'codigo' => 'error',
                'objeto' => null,
                'mensagem' => $exception->getMessage(),
            ];
        }
    }
}

