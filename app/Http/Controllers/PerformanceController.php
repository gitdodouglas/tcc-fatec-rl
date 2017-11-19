<?php

namespace App\Http\Controllers;

use App\Performance;
use Illuminate\Http\Request;

class PerformanceController extends Controller
{
    public function showAll()
    {
        return Performance::all();
    }

    public function create(Request $request)
    {
        //
    }

    public function read($id)
    {
        return $this->getPerformance($id);
    }

    public function update()
    {
        //
    }

    public function delete($id)
    {
        $performace = $this->getPerformance($id);
        $performace->delete();
        return $performace->id;
    }

    public function query($key, $value)
    {
        return Performance::where($key, $value)->first();
    }

    public function getPerformanceQuestions($id)
    {
        return Performance::find($id)->performanceQuestions;
    }

    private function getPerformance($id)
    {
        return Performance::find($id);
    }
}
