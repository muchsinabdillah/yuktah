<?php

namespace App\Repositories;

use App\Models\aactivities;
use App\Models\aprofile;
use App\Models\workposition;
use App\Repositories\Interfaces\WorkpositionRepositoryInterface;

class WorkpositionRepository implements WorkpositionRepositoryInterface
{

    public function all()
    {
        return workposition::where('name','tes')->latest()->paginate(10);
    }

    public function Store($data)
    {
        return workposition::create($data);
    }

    public function findbyid($id)
    {
        return workposition::where('uuid',$id)->where('name','tes')->get();
    }

     
    public function update($data)
    {
        $updates = workposition::where('uuid', $data['uuid'])->update([ 
            'useruuid' => $data['useruuid'], 
            'name' => $data['name'] 
        ]);
        return $updates;
    } 
    
}