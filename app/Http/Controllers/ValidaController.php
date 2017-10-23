<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Mockery\Exception;

class ValidaController extends Controller
{
    /**
     * Função que redireciona para a home do sistema.
     * Utilizada quando a rota é acessada por um método GET.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function index()
    {
        return redirect('/');
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
            /* Instancia o controller de usuário */
            $userController = new UserController;

            /* Localiza o usuário com base no e-mail informado */
            $user = $userController->query('email', $request->input('email'));

            /* Instancia o controller de validação */
            $validationController = new ValidationController;

            /* Localiza a validação com base no ID do usuário */
            $val = $validationController->query('user_id', $user->id);

            /* Verifica se a senha de primeiro acesso informada é a mesma que consta no BD */
            if (Hash::check($request->input('firstPassword'), $val->validation)) {
                /* Deleta a validação do BD */
                $val->delete();

                /* Atualiza a senha do usuário */
                $user->password = bcrypt($request->input('password'));
                $user->save();

                return [
                    'codigo' => '0',
                    'objeto' => $val,
                    'mensagem' => 'E-mail verificado com sucesso!',
                ];
            } else {
                return [
                    'codigo' => '1',
                    'objeto' => null,
                    'mensagem' => 'Não foi possível verificar o e-mail.',
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
