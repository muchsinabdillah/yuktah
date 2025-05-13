<?php

namespace App\Repositories;
 
use App\Models\learningdetail;
use Illuminate\Support\Facades\DB;
use App\Models\transactionlearningstream;
use App\Models\transactionlearningstreamdetail;
use App\Models\trslearningkuisioner;
use App\Models\trslearningkuisionerdetail;
use App\Models\trslearningpracticetest;
use App\Models\trslearningpracticetestdetail;
use App\Models\trslearningpracticetestdetails;
use App\Repositories\Interfaces\LearningStreamRepositoryInterface;
use App\Repositories\Interfaces\TrsLearningKuisionerRepositoryInterface;
use App\Repositories\Interfaces\TrsLearningPracticeRepositoryInterface;

class TrsLearningPracticeRepository implements TrsLearningPracticeRepositoryInterface
{
    public function all($useruuid)
    {
        
        $updates = DB::table('v_learningstreaminglist')->where('useruuid',$useruuid)->latest()->paginate(10);
        return $updates;
    } 
    public function alldetail($uuid)  
    {
        
        return DB::table('v_trspracticedetail')->where('learningtransactiondetail',$uuid)->get();
    }
     
    public function Store($data)
    {  
        return trslearningpracticetest::create([
            "uuid" => $data['uuid'],
            "learningtransactiondetail" => $data['learningdetailuuid'],
            "score" => 0,
            "year" => $data['year'],
            "user_created" =>   $data['user_created']
        ]);
    }
    
    public function StoreDetail($uuid,$uuidheader,$answer,$istrue,$score,$uuidquestion){
        return trslearningpracticetestdetail::create([
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
        return trslearningpracticetest::where('learningtransactiondetail',$uuid)->get();
    } 
     
    public function findbyUuid($uuid)
    {
        return trslearningpracticetest::where('uuid',$uuid)->get();
    } 
    
    public function updateItemDetailAnswer($data)
    {
        $updates = trslearningpracticetestdetail::where('uuid', $data['uuid'])->update([ 
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
        return trslearningpracticetestdetail::where('uuid',$uuid)->get();
    } 
   
    public function sumTotalfinal($uuid)  
    {
        
        return DB::table('v_sum_practicescore')->where('uuidheader',$uuid)->get();
    }  
    public function findNullDatabyUuidDetail($uuid)
    {
        return trslearningpracticetestdetail::where('uuidheader',$uuid)->where('isanswer','=','0')->get();
    } 
  
    public function updateFinalScoreStreamDetail($streamuuid,$score)
    {
        $updates = transactionlearningstreamdetail::where('uuid', $streamuuid)->update([ 
            'examscore' => $score 
        ]);
        return $updates;
    } 
     
    public function updateFinalScore($uuid,$score)
    {
        $updates = trslearningpracticetest::where('uuid', $uuid)->update([ 
            'score' => $score 
        ]);
        return $updates;
    } 
    
}