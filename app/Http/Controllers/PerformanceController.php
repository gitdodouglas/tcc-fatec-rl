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

    public function create($user)
    {
        $performance = new Performance;
        $performance->user_id = $user->id;
        $performance->user_email = $user->email;
        $performance->topic_id = 1;
        $performance->status_performance_id = 1;
        $performance->save();
        return $performance;
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
