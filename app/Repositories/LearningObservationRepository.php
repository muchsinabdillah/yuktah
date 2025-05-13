<?php

namespace App\Repositories;

use App\Models\learningobservation;
use App\Models\learningquestion;
use App\Repositories\Interfaces\LearningObservationRepositoryInterface;
use Carbon\Carbon;

class LearningObservationRepository implements LearningObservationRepositoryInterface
{

    public function all($learninguuid)
    {
        return learningobservation::where('learninguuid',$learninguuid)->latest()->paginate(10);
    }
    public function allPerLearningUuid($learninguuid)
    {
        $now = Carbon::now();
        return learningobservation::where('learninguuid',$learninguuid)
        ->where('year',$now->year) 
        ->get();
    }
    public function Store($data)
    {
        return learningobservation::create($data);
    }

    public function findbyid($id)
    {
        return learningobservation::where('uuid',$id)->get();
    }

     
    public function update($data)
    {
        $updates = learningobservation::where('uuid', $data['uuid'])->update([ 
            'question' => $data['question'],  
            'year' => $data['year'],
            'learninguuid' => $data['learninguuid'] 
        ]);
        return $updates;
    } 
    
}