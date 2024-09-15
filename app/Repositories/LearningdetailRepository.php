<?php

namespace App\Repositories;

use App\Models\aactivities;
use App\Models\aprofile;
use App\Models\learningdetail;
use App\Repositories\Interfaces\LearningdetailRepositoryInterface;

class LearningdetailRepository implements LearningdetailRepositoryInterface
{

    public function all()
    {
        return learningdetail::where('description','tes')->latest()->paginate(10);
    }

    public function Store($data)
    {
        return learningdetail::create($data);
    }

    public function findbyid($id)
    {
        return learningdetail::where('uuid',$id)->where('description','tes')->get();
    }

     
    public function update($data)
    {
        $updates = learningdetail::where('uuid', $data['uuid'])->update([ 
            'useruuid' => $data['useruuid'], 
            'description'=> $data['description'],
            'type'=> $data['type'],
            'urldocument'=> $data['urldocument'],
            'learninguuid'=> $data['learninguuid'],
            
        ]);
        return $updates;
    } 
    
}