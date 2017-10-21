<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Mockery\Exception;

class CadastroController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function store(Request $request)
    {
        try {
            $user = new User;
            $user->name = $request->name;
            $user->nickname = '0';
            $user->birth = '2015-10-10';
            $user->email = '0';
            $user->password = '0';
            $user->type_user_id = 1;
            $user->save();
            return [
                'data' => $user,
                'codigo' => '0',
                'mensagem' => 'Cadastrado com sucesso'
            ];
        } catch (Exception $e) {
            return [
                'data' => '',
                'codigo' => '1',
                'mensagem' => $e->getMessage()
            ];
        }
    }
}
