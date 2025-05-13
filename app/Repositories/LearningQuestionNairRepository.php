<?php

namespace App\Repositories;
  
use App\Models\learningquestion;
use App\Models\learningquestionnaire;
use App\Repositories\Interfaces\LearningQuestionNairRepositoryInterface;
use Carbon\Carbon;

class LearningQuestionNairRepository implements LearningQuestionNairRepositoryInterface
{

    public function all($learninguuid)
    {
        $now = Carbon::now(); 
        return learningquestionnaire::where('learninguuid',$learninguuid)
        ->where('year',$now->year)
        ->latest()->paginate(10);
    }
    public function allPerLearningUuid($learninguuid)
    {
        $now = Carbon::now();
        return learningquestionnaire::where('learninguuid',$learninguuid)
        ->where('year',$now->year)
        ->get();
    }

    public function Store($data)
    {
        return learningquestionnaire::create($data);
    }

    public function findbyid($id)
    {
        return learningquestionnaire::where('uuid',$id)->get();
    }

     
    public function update($data)
    {
        $updates = learningquestionnaire::where('uuid', $data['uuid'])->update([ 
            'name' => $data['name'],  
            'year' => $data['year'],  
            'type' => $data['type'],  
            'learninguuid' => $data['learninguuid'] 
        ]);
        return $updates;
    } 
    
}