<?php

namespace App\Http\Controllers;

use App\Validation;
use Illuminate\Http\Request;

class ValidationController extends Controller
{
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
}
