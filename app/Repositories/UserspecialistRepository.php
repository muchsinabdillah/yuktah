<?php

namespace App\Repositories;

use App\Models\aactivities;
use App\Models\aprofile;
use App\Models\userspecialist;
use App\Repositories\Interfaces\UserspecialistRepositoryInterface;

class UserspecialistRepository implements UserspecialistRepositoryInterface
{

    public function all()
    {
        return userspecialist::where('specialistuuid','1')->latest()->paginate(10);
    }

    public function Store($data)
    {
        return userspecialist::create($data);
    }

    public function findbyid($id)
    {
        return userspecialist::where('uuid',$id)->where('name','1')->get();
    }

     
    public function update($data)
    {
        $updates = userspecialist::where('uuid', $data['uuid'])->update([ 
            'specialistuuid' => $data['specialistuuid'],
            'useruuid' => $data['useruuid'] 

        ]);
        return $updates;
    } 
    
}