<?php

namespace App\Repositories;
 
use App\Models\learninggroup;
use App\Repositories\Interfaces\LearningGroupRepositoryInterface;

class LearningGroupRepository implements LearningGroupRepositoryInterface
{

    public function all()
    {
        return learninggroup::latest()->paginate(10);
    }

    public function Store($data)
    {
        return learninggroup::create($data);
    }

    public function findbyid($id)
    {
        return learninggroup::where('uuid',$id)->get();
    }

     
    public function update($data)
    {
        $updates = learninggroup::where('uuid', $data['uuid'])->update([ 
            'useruuid' => $data['useruuid'], 
            'name' => $data['name'] 
        ]);
        return $updates;
    } 
    
}