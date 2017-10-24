<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    /**
     * Função que redireciona para a url correta.
     * Utilizada quando a rota é acessada por um método GET.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function index()
    {
        Auth::logout();
        return redirect('/#/logout');
    }

    /**
     * Função que realiza o logout do usuário.
     *
     * @return array
     */
    public function logout()
    {
        try {
            Auth::logout();
            return [
                'codigo' => '0',
                'objeto' => null,
                'mensagem' => 'Usuário desconectado!',
            ];
        } catch (Exception $exception) {
            return [
                'codigo' => '1',
                'objeto' => null,
                'mensagem' => $exception->getMessage(),
            ];
        }
    }
}
