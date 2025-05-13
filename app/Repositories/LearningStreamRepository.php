<?php

namespace App\Repositories;
 
use App\Models\learningdetail;
use Illuminate\Support\Facades\DB;
use App\Models\transactionlearningstream;
use App\Models\transactionlearningstreamdetail;
use App\Repositories\Interfaces\LearningStreamRepositoryInterface;

class LearningStreamRepository implements LearningStreamRepositoryInterface
{
    public function all($useruuid)
    {
        
        $updates = DB::table('v_learningstreaminglist')->where('useruuid',$useruuid)->latest()->paginate(10);
        return $updates;
    }
    public function findbyLearningModuleListbyId($uuid)
    {
        
        $updates = DB::table('v_learningstreammodullist')->where('streamuuid',$uuid)->latest()->paginate(10);
        return $updates;
    }
    public function findbyLearningAndUserid($data)
    {
        return  DB::table('v_learningstreambylearningid')
                ->where('learninguuid',$data->learninguuid)
                ->where('useruuid',$data->useruuid)
                ->where('uuid',$data->streamuuid)
                ->get();
    }
    public function findbyLearningStreamId($uuid)
    {
        return  DB::table('v_learningstreammodullist') 
                ->where('uuid',$uuid)
                ->get();
    }
    public function findbyLearningStreambyDetailUuid($uuid)
    {
        return  DB::table('transactionlearningstreamdetails') 
                ->where('uuid',$uuid)
                ->get();
    }
    public function Store($uuid,$learningtrsuuid,$certprogress,$totalmodul,$totalfinish, $isFinish, $useruuid, $learninguuid)
    { 
        return transactionlearningstream::create([
            "uuid"=> $uuid,
            "learningtrsuuid"=> $learningtrsuuid,
            "certprogress"=> $certprogress,
            "totalmodul"=> $totalmodul,
            "totalfinish"=> $totalfinish,
            "useruuid" => $useruuid,
            "learninguuid" => $learninguuid,
            "isfinish"=> $isFinish
        ]);
    }
    public function StoreDetail($uuid,$learningtrsuuid,$learninguuid,$minutesprogress,$isfinish,$minutesstart,$learningdetailuuid,$streamuuid){
        return transactionlearningstreamdetail::create([
            "uuid"=> $uuid,
            "learningtrsuuid"=> $learningtrsuuid,
            "learninguuid"=> $learninguuid,
            "learningdetailuuid"=> $learningdetailuuid,
            "minutesprogress"=> $minutesprogress,
            'minutesstart' => $minutesstart,
            'streamuuid' => $streamuuid,
            "isfinish"=> $isfinish 
        ]);
    }
    public function updateStream($data)
    {
        $updates = transactionlearningstreamdetail::where('uuid', $data['uuid'])->update([ 
            'minutesstart' => $data['minutesstart'], 
            'minutesprogress'=> $data['minutesprogress'], 
            'isfinish'=> $data['isfinish'] 
        ]);
        return $updates;
    } 
    public function updateStreamHeader($data)
    {
        $updates = transactionlearningstream::where('uuid', $data['streamuuid'])->update([ 
            'certprogress' => $data['certprogress'], 
            'totalfinish'=> $data['totalfinish'], 
            'isfinish'=> $data['isfinishheader'] 
        ]);
        return $updates;
    } 
    public function finddetailstreamModulbyUserid($useruuid)
    {
        
        $updates = DB::table('v_learningstreammodullist')->where('useruuid',$useruuid)->latest()->paginate(10);
        return $updates;
    }
    
}