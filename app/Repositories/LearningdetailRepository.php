<?php

namespace App\Repositories;

use App\Models\aactivities;
use App\Models\aprofile;
use App\Models\learningdetail;
use App\Repositories\Interfaces\LearningdetailRepositoryInterface;
use Illuminate\Support\Facades\DB;

class LearningdetailRepository implements LearningdetailRepositoryInterface
{

    public function all()
    {
        return learningdetail::latest()->paginate(10);
    }

    public function Store($data)
    {
        return learningdetail::create($data);
    }

    public function findbyid($id)
    {
        return learningdetail::where('learninguuid',$id)->get();
    }
    public function findbyUuid($uuid)
    {
        return learningdetail::where('uuid',$uuid)->get();
    }
    public function findDataLearningCertbyUuid($uuid)
    { 
        $updates = DB::table('v_learningdetailcertbyuuid')->where('uuid',$uuid)->get();
        return $updates;
    }
    public function showdetailbylearningid($id)
    {
        return learningdetail::latest()->where('learninguuid',$id)->paginate(10);
    }

    public function update($data)
    { 
          $updates = learningdetail::where('uuid', $data['uuid'])->update([ 
            'description' => $data['description'],
            'useruuid' => $data['useruuid'],
            'type' => $data['type'],
            'filevideo' => $data['filevideo'],
            'jp' => $data['jp'],
            'filedocument' => $data['filedocument']
        ]);
        return $updates;
    } 
    
}