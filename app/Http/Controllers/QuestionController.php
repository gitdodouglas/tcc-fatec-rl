<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function showAll()
    {
        return Question::all();
    }

    public function create(Request $request)
    {
        //
    }

    public function read($id)
    {
        return $this->getQuestion($id);
    }

    public function update()
    {
        //
    }

    public function delete($id)
    {
        $question = $this->getQuestion($id);
        $question->delete();
        return $question->id;
    }

    public function query($key, $value)
    {
        return Question::where($key, $value)->first();
    }

    public function getAlternatives($id)
    {
        return Question::find($id)->alternatives;
    }

    private function getQuestion($id)
    {
        return Question::find($id);
    }
}
