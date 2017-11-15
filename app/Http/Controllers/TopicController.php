<?php

namespace App\Http\Controllers;

use App\Question;
use App\Topic;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    public function showAll()
    {
        return Topic::all();
    }

    public function create(Request $request)
    {
        //
    }

    public function read($id)
    {
        return $this->getTopic($id);
    }

    public function update()
    {
        //
    }

    public function delete($id)
    {
        $topic = $this->getTopic($id);
        $topic->delete();
        return $topic->id;
    }

    public function query($key, $value)
    {
        return Topic::where($key, $value)->first();
    }

    public function getQuestions($id)
    {
        return Question::find($id)->questions;
    }

    private function getTopic($id)
    {
        return Topic::find($id);
    }
}
