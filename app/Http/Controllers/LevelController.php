<?php

namespace App\Http\Controllers;

use App\Level;
use Illuminate\Http\Request;

class LevelController extends Controller
{
    public function showAll()
    {
        return Level::all();
    }

    public function create(Request $request)
    {
        //
    }

    public function read($id)
    {
        return $this->getLevel($id);
    }

    public function update()
    {
        //
    }

    public function delete($id)
    {
        $level = $this->getLevel($id);
        $level->delete();
        return $level->id;
    }

    public function query($key, $value)
    {
        return Level::where($key, $value)->first();
    }

    public function getTopics($id)
    {
        return Level::find($id)->topics;
    }

    private function getLevel($id)
    {
        return Level::find($id);
    }
}
