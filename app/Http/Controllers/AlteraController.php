<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AlteraController extends Controller
{
    /**
     * Função que redireciona para a url correta.
     * Utilizada quando a rota é acessada por um método GET.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function index()
    {
        return redirect('/#!altera');
    }

    /**
     * Função que valida o e-mail do usuário.
     *
     * @param Request $request
     * @return array
     */
    public function verify(Request $request)
    {
        try {
            /* Verifica se a origem da requisição está autorizada */
            if ($request->json('token') != ( md5(session()->get('$_EMAIL') . session()->get('$_TOKEN')) )) {
                throw new \Exception('Acesso não autorizado.');
            } else {

                /* Verifica a entrada de dados */
                if ($request->json('old_password') == "" || $request->json('new_password') == "" || $request->json('confirm_password') == "") {
                    throw new \Exception('Todos os campos são de preenchimento obrigatório.');
                } else {

                    /* Verifica se a senha digitada é igual a confirmação da senha */
                    if ($request->json('new_password') != $request->json('confirm_password')) {
                        throw new \Exception('A senhas digitadas não correspondem.');
                    } else {

                        /* Instancia o controller de usuário */
                        $userController = new UserController;

                        /* Localiza o usuário com base no e-mail informado */
                        $user = $userController->query('email', session()->get('$_EMAIL'));

                        /* Verifica se a senha de primeiro acesso informada é a mesma que consta no BD */
                        if (Hash::check($request->json('old_password'), $user->password)) {

                            /* Atualiza a senha do usuário */
                            $user->password = bcrypt($request->json('new_password'));
                            $user->save();

                            /* Insere os dados de ativação do cadastro */
                            if (!$user->activated_at) {
                                $user->activated_at = $user->updated_at;
                                $user->save();

                                /* Instancia o controller de desempenho do tópico */
                                $performanceController = new PerformanceController;

                                /* Cria o desempenho inicial do usuário */
                                $performanceController->create($user);
                            }

                            /* Realiza a tentativa de login usando o e-mail e senha informados */
                            if (Auth::attempt(['email' => session()->get('$_EMAIL'), 'password' => $request->json('new_password')])) {

                                /* Gera o token de validação da sessão */
                                $token = hash('sha256', $request . microtime());

                                /* Armazena o token em session */
                                session()->put('$_TOKEN', $token);

                                return [
                                    'codigo' => 'success',
                                    'objeto' => [
                                        'info' => Auth::user(),
                                        'token' => $token,
                                    ],
                                    'mensagem' => null,
                                ];
                            } else {
                                throw new \Exception('Não foi possível realizar a autenticação.');
                            }

                        } else {
                            throw new \Exception('A senha enviada por e-mail não confere.');
                        }

                    }

                }
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
