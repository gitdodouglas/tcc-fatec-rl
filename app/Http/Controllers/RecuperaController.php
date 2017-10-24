<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RecuperaController extends Controller
{
    /**
     * Função que redireciona para a url correta.
     * Utilizada quando a rota é acessada por um método GET.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function index()
    {
        return redirect('/#/recupera');
    }

    public function reset(Request $request)
    {
        //
    }
}
