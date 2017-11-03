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
        /* Verifica a entrada de dados */
        if ($request->json('email') == "" || $request->json('password') == "") {
            return [
                'codigo' => 'error',
                'objeto' => null,
                'mensagem' => 'Todos os campos são de preenchimento obrigatório.',
            ];
        }

        try {
            /* Instancia o controller de usuário */
            $userController = new UserController;

            /* Verifica se o usuário existe */
            if ($user = $userController->query('email', $request->json('email'))) {

                /* Verifica se o cadastro foi validado */
                if ($user->created_at == $user->updated_at && Hash::check($request->json('password'), $user->password)) {
                    return [
                        'codigo' => 'error',
                        'objeto' => null,
                        'mensagem' => 'É necessário que valide o seu e-mail antes de efetuar o login pela primeira vez.',
                    ];
                } else {
                    /* Realiza a tentativa de login usando o e-mail e senha informados */
                    if (Auth::attempt(['email' => $request->json('email'), 'password' => $request->json('password')])) {
                        /* Instancia o controller de validação */
                        $validationController = new ValidationController;

                        /* Gera o token de validação da sessão */
                        $token = hash('sha256', $request . microtime());

                        /* Cria a validação */
                        $validationController->create(Auth::user(), $token, 1);

                        return [
                            'codigo' => 'success',
                            'objeto' => Auth::user(),
                            'token' => $token,
                            'mensagem' => null,
                        ];
                    } else {
                        return [
                            'codigo' => 'error',
                            'objeto' => null,
                            'mensagem' => 'E-mail ou senha inválidos.',
                        ];
                    }
                }

            } else {
                return [
                    'codigo' => 'error',
                    'objeto' => null,
                    'mensagem' => 'E-mail ou senha inválidos.',
                ];
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

