<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RecuperaController extends Controller
{
    public function index()
    {
        return redirect('/');
    }

    public function reset(Request $request)
    {
        //
    }
}
