<?php

namespace App\Repositories;

use App\Models\aprofile;
use App\Models\learning;
use App\Models\aactivities;
use Illuminate\Support\Facades\DB;
use App\Repositories\Interfaces\LearningRepositoryInterface;

class LearningRepository implements LearningRepositoryInterface
{

    public function all()
    {
        return learning::latest()->paginate(10);
    }

    public function Store($data)
    {
        return learning::create($data);
    }

    public function findbyid($id)
    {
        return learning::where('uuid',$id)->get();
    }
    public function findbyUuidGroupid($uuid)
    {
        
        return DB::table('v_learningbygroupuuid')->where('uuidgrouplearning',$uuid)->latest()->paginate(10);
    }
     
    public function update($data)
    {
        $updates = learning::where('uuid', $data['uuid'])->update([ 
            'useruuid' => $data['useruuid'], 
            'title'=> $data['title'], 
            'shortdescription'=> $data['shortdescription'], 
            'studentcount'=> $data['studentcount'], 
            'ratingcount'=> $data['ratingcount'], 
            'rating'=> $data['rating'], 
            'mentoruuid'=> $data['mentoruuid'], 
            'learndetail'=> $data['learndetail'], 
            'benefitcourse'=> $data['benefitcourse'], 
            'requirment'=> $data['requirment'], 
            'description'=> $data['description'], 
            'cover'=> $data['cover'], 
            'price'=> $data['price'], 
            'place'=> $data['place'], 
            'learninglevel'=> $data['learninglevel'], 
            'learningdate' =>  $data['learningdate'], 
            'contactperson'=> $data['contactperson'], 
            'gmaplocation'=> $data['gmaplocation'], 
            'status'=> $data['status']
        ]);
        return $updates;
    } 
    public function updatemodule($data)
    {
        $updates = learning::where('uuid', $data['uuid'])->increment('totalmodul');
        return $updates;
 
    } 
    
}