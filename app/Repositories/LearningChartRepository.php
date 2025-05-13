<?php

namespace App\Repositories;

use App\Models\chart;
use App\Models\learningdetail;
use App\Models\transactionlearning;
use Illuminate\Support\Facades\DB;
use App\Repositories\Interfaces\LearningChartRepositoryInterface; 

class LearningChartRepository implements LearningChartRepositoryInterface
{
    public function all($useruuid)
    { 

        $updates = DB::table('v_learninglistbychart')->where('useruuid',$useruuid)->latest()->paginate(10);
        return $updates;
    }
    public function allwithoutPaging($useruuid)
    { 

        $updates = DB::table('v_learninglistbychart')->where('useruuid',$useruuid)->get();
        return $updates;
    }
    
    public function Store($data)
    {
        return chart::create($data);
    }
    public function delete($data)
    {
        $updates = DB::table('charts')->where('useruuid',$data['useruuid'])->delete();  
        return $updates;
    }
    public function deleteuuid($data)
    {
        $updates = DB::table('charts')->where('uuid',$data['uuid'])->delete();  
        return $updates;
    }
}