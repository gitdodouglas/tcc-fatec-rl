<?php

namespace App\Http\Controllers;

use App\Content;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function showAll()
    {
        return Content::all();
    }

    public function create(Request $request)
    {
        //
    }

    public function read($id)
    {
        return $this->getContent($id);
    }

    public function update()
    {
        //
    }

    public function delete($id)
    {
        $content = $this->getContent($id);
        $content->delete();
        return $content->id;
    }

    public function query($key, $value)
    {
        return Content::where($key, $value)->first();
    }

    private function getContent($id)
    {
        return Content::find($id);
    }
}
