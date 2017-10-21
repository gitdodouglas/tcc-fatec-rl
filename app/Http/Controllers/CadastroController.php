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
            $user->name = $request->input('name');
            $user->nickname = $request->input('nickname');
            $user->birth = $request->input('birth');
            $user->email = $request->input('email');
            $user->password = bcrypt($request->input('password'));
            $user->type_user_id = 1;
            $user->save();
            return [
                'codigo' => '0',
                'objeto' => $user,
                'mensagem' => 'Cadastrado com sucesso',
            ];
        } catch (Exception $exception) {
            return [
                'codigo' => '1',
                'objeto' => '',
                'mensagem' => $exception->getMessage(),
            ];
        }
    }
}
