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

    public function create(Request $request, $typeUserId)
    {
        $user = new User;
        $user->name = $request->input('name');
        $user->nickname = $request->input('nickname');
        $user->birth = $request->input('birth');
        $user->email = $request->input('email');
        $user->password = bcrypt(microtime());
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
