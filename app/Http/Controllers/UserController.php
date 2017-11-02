<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function showAll()
    {
        return User::all();
    }

    public function create(Request $request, $pass, $typeUserId)
    {
        $user = new User;
        $user->name = $request->json('name');
        $user->nickname = $request->json('nickname');
        if (!$user->birth = date_create(str_replace('/', '-', $request->json('birth')))) {
            throw new \Exception('Data de nascimento inválida.');
        }
        $user->email = $request->json('email');
        $user->password = bcrypt($pass);
        $user->type_user_id = $typeUserId;
        $user->save();
        return $user;
    }

    public function read($id)
    {
        return $this->getUser($id);
    }

    public function update()
    {
        //
    }

    public function delete($id)
    {
        $user = $this->getUser($id);
        $user->delete();
        return $user->id;
    }

    public function query($key, $value)
    {
        return User::where($key, $value)->first();
    }

    private function getUser($id)
    {
        return User::find($id);
    }
}
