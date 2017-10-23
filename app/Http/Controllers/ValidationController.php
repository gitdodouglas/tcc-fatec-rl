<?php

namespace App\Http\Controllers;

use App\Validation;

class ValidationController extends Controller
{
    public function showAll()
    {
        return Validation::all();
    }

    public function create($validation, $userId, $userEmail, $typeValidationId)
    {
        $val = new Validation;
        $val->validation = bcrypt($validation);
        $val->user_id = $userId;
        $val->user_email = $userEmail;
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
