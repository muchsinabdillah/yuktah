<?php

namespace App\Repositories;
 
use App\Models\learningdetail;
use Illuminate\Support\Facades\DB;
use App\Models\transactionlearningstream;
use App\Models\transactionlearningstreamdetail;
use App\Models\trslearningkuisioner;
use App\Models\trslearningkuisionerdetail;
use App\Repositories\Interfaces\LearningStreamRepositoryInterface;
use App\Repositories\Interfaces\TrsLearningKuisionerRepositoryInterface;

class TrsLearningKuisionerRepository implements TrsLearningKuisionerRepositoryInterface
{
    public function all($useruuid)
    {
        
        $updates = DB::table('v_learningstreaminglist')->where('useruuid',$useruuid)->latest()->paginate(10);
        return $updates;
    } 
    public function alldetail($uuid)  
    {
        
        return DB::table('v_trskuisionerdetail')->where('learningtransactiondetail',$uuid)->get();
    }
    public function Store($data)
    {  
        return trslearningkuisioner::create([
            "uuid" => $data['uuid'],
            "learningtransactiondetail" => $data['learningdetailuuid'],
            "score" => 0,
            "year" => $data['year'],
            "user_created" =>   $data['user_created']
        ]);
    }
    public function StoreDetail($uuid,$uuidheader,$answer,$istrue,$score,$uuidquestion){
        return trslearningkuisionerdetail::create([
            "uuid"=> $uuid,
            "uuidheader" => $uuidheader, 
            "uuidquestion" => $uuidquestion,
            "answer"=> $answer,
            "istrue"=> 0, 
            "score"=> 0 
        ]);
    } 
    public function findbyid($uuid)
    {
        return trslearningkuisioner::where('learningtransactiondetail',$uuid)->get();
    } 
    public function findbyUuid($uuid)
    {
        return trslearningkuisioner::where('uuid',$uuid)->get();
    } 
    public function updateItemDetailAnswer($data)
    {
        $updates = trslearningkuisionerdetail::where('uuid', $data['uuid'])->update([ 
            'answer' => $data['answer'],
            'score' => $data['answer'] 
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
        return trslearningkuisionerdetail::where('uuid',$uuid)->get();
    } 
    public function sumkuisionerfinal($uuid)  
    {
        
        return DB::table('v_sum_kuisionerfinal')->where('uuidheader',$uuid)->get();
    }
    public function findNullDatabyUuidDetail($uuid)
    {
        return trslearningkuisionerdetail::where('uuidheader',$uuid)->where('score','=','0')->get();
    } 
    public function updateFinalScoreStreamDetail($streamuuid,$score)
    {
        $updates = transactionlearningstreamdetail::where('uuid', $streamuuid)->update([ 
            'kuisionerscore' => $score 
        ]);
        return $updates;
    } 
    public function updateFinalScoreKuisioner($uuid,$score)
    {
        $updates = trslearningkuisioner::where('uuid', $uuid)->update([ 
            'score' => $score 
        ]);
        return $updates;
    } 
}