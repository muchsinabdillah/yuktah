<?php

namespace App\Repositories;
  
use Illuminate\Support\Facades\DB;
use App\Models\transactionlearningstream;
use App\Models\transactionlearningstreamdetail; 
use App\Models\trslearningkuisionerdetail;
use App\Models\trslearningposttest;
use App\Models\trslearningposttestdetail;
use App\Models\trslearningpretest;
use App\Models\trslearningpretestdetail;
use App\Repositories\Interfaces\TrsLearningQuestionRepositoryInterface;

class TrsLearningQuestionRepository implements TrsLearningQuestionRepositoryInterface
{
    public function all($useruuid)
    {
        
        $updates = DB::table('v_learningstreaminglist')->where('useruuid',$useruuid)->latest()->paginate(10);
        return $updates;
    } 
    public function alldetail($uuid)  
    {
        
        return DB::table('v_trspretestdetail')->where('learningtransactiondetail',$uuid)->get();
    }
    public function alldetailPosttest($uuid)  
    {
        
        return DB::table('v_trsposttestdetail')->where('learningtransactiondetail',$uuid)->get();
    }
    public function Store($data)
    {  
        return trslearningpretest::create([
            "uuid" => $data['uuid'],
            "learningtransactiondetail" => $data['learningdetailuuid'],
            "score" => 0,
            "year" => $data['year'],
            "user_created" =>   $data['user_created']
        ]);
    }
    public function StorePostTest($data)
    {  
        return trslearningposttest::create([
            "uuid" => $data['uuid'],
            "learningtransactiondetail" => $data['learningdetailuuid'],
            "score" => 0,
            "year" => $data['year'],
            "user_created" =>   $data['user_created']
        ]);
    }
    public function StoreDetail($uuid,$uuidheader,$answer,$istrue,$score,$uuidquestion){
        return trslearningpretestdetail::create([
            "uuid"=> $uuid,
            "uuidheader" => $uuidheader, 
            "uuidquestion" => $uuidquestion,
            "answer"=> $answer,
            "isanswer"=> 0, 
            "score"=> 0 
        ]);
    } 
    public function StoreDetailPosttest($uuid,$uuidheader,$answer,$istrue,$score,$uuidquestion){
        return trslearningposttestdetail::create([
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
        return trslearningpretest::where('learningtransactiondetail',$uuid)->get();
    } 
    public function findposttestbyid($uuid)
    {
        return trslearningposttest::where('learningtransactiondetail',$uuid)->get();
    } 
    public function findbyUuid($uuid)
    {
        return trslearningpretest::where('uuid',$uuid)->get();
    } 
    public function findbyUuidPosttest($uuid)
    {
        return trslearningposttest::where('uuid',$uuid)->get();
    } 
    public function updateItemDetailAnswer($data)
    {
        $updates = trslearningpretestdetail::where('uuid', $data['uuid'])->update([ 
            'answer' => $data['answer'],
            'isanswer' => $data['isanswer'],
            'score' => $data['score'] 
        ]);
        return $updates;
    } 
    public function updateItemDetailAnswerPosttest($data)
    {
        $updates = trslearningposttestdetail::where('uuid', $data['uuid'])->update([ 
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
        return trslearningpretestdetail::where('uuid',$uuid)->get();
    } 
    public function findbyUuidDetailPosttest($uuid)
    {
        return trslearningposttestdetail::where('uuid',$uuid)->get();
    } 
    public function sumTotalfinal($uuid)  
    {
        
        return DB::table('v_sum_pretestscore')->where('uuidheader',$uuid)->get();
    }  
    public function sumTotalfinalposttest($uuid)  
    {
        
        return DB::table('v_sum_posttestscore')->where('uuidheader',$uuid)->get();
    } 
    public function findNullDatabyUuidDetail($uuid)
    {
        return trslearningpretestdetail::where('uuidheader',$uuid)->where('isanswer','=','0')->get();
    } 
    public function findNullDatabyUuidDetailPosttest($uuid)
    {
        return trslearningpretestdetail::where('uuidheader',$uuid)->where('isanswer','=','0')->get();
    } 
    public function updateFinalScoreStreamDetail($streamuuid,$score)
    {
        $updates = transactionlearningstreamdetail::where('uuid', $streamuuid)->update([ 
            'pretestscore' => $score 
        ]);
        return $updates;
    } 
    public function updateFinalScoreStreamDetailPost($streamuuid,$score)
    {
        $updates = transactionlearningstreamdetail::where('uuid', $streamuuid)->update([ 
            'posttestscore' => $score 
        ]);
        return $updates;
    } 
    public function updateFinalScore($uuid,$score)
    {
        $updates = trslearningpretest::where('uuid', $uuid)->update([ 
            'score' => $score 
        ]);
        return $updates;
    } 
    public function updateFinalScorePosttest($uuid,$score)
    {
        $updates = trslearningposttest::where('uuid', $uuid)->update([ 
            'score' => $score 
        ]);
        return $updates;
    } 
}