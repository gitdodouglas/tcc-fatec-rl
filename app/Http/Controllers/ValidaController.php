<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ValidaController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function verify(Request $request)
    {
        //
    }
}
