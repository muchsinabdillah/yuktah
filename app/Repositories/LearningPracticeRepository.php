<?php

namespace App\Repositories;

use App\Models\learningobservation;
use App\Models\learningpractice;
use App\Repositories\Interfaces\LearningPracticeRepositoryInterface;
use Carbon\Carbon;

class LearningPracticeRepository implements LearningPracticeRepositoryInterface
{

    public function all($learninguuid)
    {
        return learningpractice::where('learninguuid',$learninguuid)->latest()->paginate(10);
    }
    public function allPerLearningUuid($learninguuid)
    {
        $now = Carbon::now();
        return learningpractice::where('learninguuid',$learninguuid)
        ->where('year',$now->year) 
        ->get();
    }
    public function Store($data)
    {
        return learningpractice::create($data);
    }

    public function findbyid($id)
    {
        return learningpractice::where('uuid',$id)->get();
    }

     
    public function update($data)
    {
        $updates = learningpractice::where('uuid', $data['uuid'])->update([ 
            'question' => $data['question'],  
            'year' => $data['year'],
            'learninguuid' => $data['learninguuid'] 
        ]);
        return $updates;
    } 
    
}