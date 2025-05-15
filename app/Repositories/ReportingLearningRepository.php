<?php

namespace App\Repositories;
 
use App\Models\regencie;
 
use Illuminate\Support\Facades\DB;
use App\Repositories\Interfaces\ReportingLearningRepositoryInterface;
 

class ReportingLearningRepository implements ReportingLearningRepositoryInterface
{
    public function index()
    {
          $updates = DB::table('v_learningstreammodullist')->get();
        return $updates;
    }
    public function all()
    {
        // return regencie::where('uuid','1')->latest()->paginate(10);

        $updates = DB::table('v_learningstreammodullist')->get();
        return $updates;
    }
 
    
}