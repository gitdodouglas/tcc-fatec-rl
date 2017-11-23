<?php

namespace App\Http\Controllers;

use App\Alternative;
use Illuminate\Http\Request;

class AlternativeController extends Controller
{
    public function showAll()
    {
        return Alternative::all();
    }

    public function create(Request $request)
    {
        //
    }

    public function read($id)
    {
        return $this->getAlternative($id);
    }

    public function update()
    {
        //
    }

    public function delete($id)
    {
        $alternative = $this->getAlternative($id);
        $alternative->delete();
        return $alternative->id;
    }

    public function query($key, $value)
    {
        return Alternative::where($key, $value)->first();
    }

    public function getQuestion($id)
    {
        return Alternative::find($id)->question;
    }

    private function getAlternative($id)
    {
        return Alternative::find($id);
    }
}
