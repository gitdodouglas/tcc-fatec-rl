<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    /**
     * Função que retorna a view 'index', ou seja, a home do sistema.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('index');
    }
}