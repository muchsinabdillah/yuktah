<?php

namespace App\Repositories;
 
use App\Models\learningdetail;
use Illuminate\Support\Facades\DB;
use App\Models\transactionlearningstream;
use App\Models\transactionlearningstreamdetail;
use App\Models\trslearningkuisioner;
use App\Models\trslearningkuisionerdetail;
use App\Models\trslearningobservation;
use App\Models\trslearningobservationdetail;
use App\Repositories\Interfaces\LearningStreamRepositoryInterface;
use App\Repositories\Interfaces\TrsLearningKuisionerRepositoryInterface;
use App\Repositories\Interfaces\TrsLearningObservationRepositoryInterface;
use App\Repositories\Interfaces\TrsLearningPracticeRepositoryInterface;

class TrsLearningObservationRepository implements TrsLearningObservationRepositoryInterface
{
    public function all($useruuid)
    {
        
        $updates = DB::table('v_learningstreaminglist')->where('useruuid',$useruuid)->latest()->paginate(10);
        return $updates;
    } 
    public function alldetail($uuid)  
    {
        
        return DB::table('v_trsobservationdetail')->where('learningtransactiondetail',$uuid)->get();
    }
  
    public function Store($data)
    {  
        return trslearningobservation::create([
            "uuid" => $data['uuid'],
            "learningtransactiondetail" => $data['learningdetailuuid'],
            "score" => 0,
            "year" => $data['year'],
            "user_created" =>   $data['user_created']
        ]);
    }
   
    public function StoreDetail($uuid,$uuidheader,$answer,$istrue,$score,$uuidquestion){
        return trslearningobservationdetail::create([
            "uuid"=> $uuid,
            "uuidheader" => $uuidheader, 
            "uuidquestion" => $uuidquestion,
            "answer"=> $answer,
            "isanswer"=> 0, 
            "score"=> 0 
        ]);
    } 
 
    public function findbyid($uuid)
    {
        return trslearningobservation::where('learningtransactiondetail',$uuid)->get();
    } 
     
    public function findbyUuid($uuid)
    {
        return trslearningobservation::where('uuid',$uuid)->get();
    } 
     
    public function updateItemDetailAnswer($data)
    {
        $updates = trslearningobservationdetail::where('uuid', $data['uuid'])->update([ 
            'answer' => $data['answer'],
            'isanswer' => $data['isanswer'],
            'score' => $data['score'] 
        ]);
        return $updates;
    } 
    
    public function updateGlobal($data)
    {
        $updates = transactionlearningstream::where('uuid', $data['streamuuid'])->update([ 
            'certprogress' => $data['certprogress'], 
            'totalfinish'=> $data['totalfinish'], 
            'isfinish'=> $data['isfinishheader'] 
        ]);
        return $updates;
    } 
    public function findbyUuidDetail($uuid)
    {
        return trslearningobservationdetail::where('uuid',$uuid)->get();
    } 
    
    public function sumTotalfinal($uuid)  
    {
        
        return DB::table('v_sum_observationscore')->where('uuidheader',$uuid)->get();
    }  
    
    public function findNullDatabyUuidDetail($uuid)
    {
        return trslearningobservationdetail::where('uuidheader',$uuid)->where('isanswer','=','0')->get();
    } 
    
    public function updateFinalScoreStreamDetail($streamuuid,$score)
    {
        $updates = transactionlearningstreamdetail::where('uuid', $streamuuid)->update([ 
            'observasiscore' => $score 
        ]);
        return $updates;
    } 
    
    public function updateFinalScore($uuid,$score)
    {
        $updates = trslearningobservation::where('uuid', $uuid)->update([ 
            'score' => $score 
        ]);
        return $updates;
    } 
    public function updateFinalResultStreamDetail($streamuuid,$score)
    {
        $updates = transactionlearningstreamdetail::where('uuid', $streamuuid)->update([ 
            'finalscore' => $score 
        ]);
        return $updates;
    } 
}