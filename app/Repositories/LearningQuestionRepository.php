<?php

namespace App\Repositories;
  
use App\Models\learningquestion;
use App\Repositories\Interfaces\LearningQuestionRepositoryInterface;
use Carbon\Carbon;

class LearningQuestionRepository implements LearningQuestionRepositoryInterface
{

    public function all($learninguuid)
    {
        return learningquestion::where('learninguuid',$learninguuid)->latest()->paginate(10); 
    }
    public function allPerLearningUuid($learninguuid,$type)
    {
        $now = Carbon::now();
        return learningquestion::where('learninguuid',$learninguuid)
        ->where('year',$now->year)
        ->where('type',$type)
        ->get();
    }
    public function Store($data)
    {
        return learningquestion::create($data);
    }

    public function findbyid($id)
    {
        return learningquestion::where('uuid',$id)->get();
    }

     
    public function update($data)
    {
        $updates = learningquestion::where('uuid', $data['uuid'])->update([ 
            'question' => $data['question'], 
            'answer' => $data['answer'],
            'year' => $data['year'],
            'learninguuid' => $data['learninguuid'] 
        ]);
        return $updates;
    } 
    
}