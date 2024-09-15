<?php

namespace App\Repositories;

use App\Models\aactivities;
use App\Models\aprofile;
use App\Models\learningeventgroup;
use App\Repositories\Interfaces\LearningeventGroupRepositoryInterface;

class LearningeventGroupRepository implements LearningeventGroupRepositoryInterface
{

    public function all()
    {
        return learningeventgroup::where('name','tes')->latest()->paginate(10);
    }

    public function Store($data)
    {
        return learningeventgroup::create($data);
    }

    public function findbyid($id)
    {
        return learningeventgroup::where('uuid',$id)->where('name','tes')->get();
    }

     
    public function update($data)
    {
        $updates = learningeventgroup::where('uuid', $data['uuid'])->update([ 
            'useruuid' => $data['useruuid'], 
            'name' => $data['name'] 
        ]);
        return $updates;
    } 
    
}