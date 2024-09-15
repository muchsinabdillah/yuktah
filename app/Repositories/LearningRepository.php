<?php

namespace App\Repositories;

use App\Models\aactivities;
use App\Models\aprofile;
use App\Models\learning;
use App\Repositories\Interfaces\LearningRepositoryInterface;

class LearningRepository implements LearningRepositoryInterface
{

    public function all()
    {
        return learning::where('title','tes')->latest()->paginate(10);
    }

    public function Store($data)
    {
        return learning::create($data);
    }

    public function findbyid($id)
    {
        return learning::where('uuid',$id)->where('title','tes')->get();
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
            'price'=> $data['price'], 
            'status'=> $data['status']
        ]);
        return $updates;
    } 
    
}