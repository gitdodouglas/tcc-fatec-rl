<?php

namespace App\Http\Controllers;

use App\User;
use App\Validation;

class ValidationController extends Controller
{
    public function showAll()
    {
        return Validation::all();
    }

    public function create(User $user, $validation, $typeValidationId)
    {
        $val = new Validation;
        $val->validation = bcrypt($validation);
        $val->user_id = $user->id;
        $val->user_email = $user->email;
        $val->type_validation_id = $typeValidationId;
        $val->save();
        return $val;
    }

    public function read($id)
    {
        return $this->getValidation($id);
    }

    public function update()
    {
        //
    }

    public function delete($id)
    {
        $val = $this->getValidation($id);
        $val->delete();
        return $val->id;
    }

    public function query($key, $value)
    {
        return Validation::where($key, $value)->first();
    }

    private function getValidation($id)
    {
        return Validation::find($id);
    }
}
