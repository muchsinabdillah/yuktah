<?php

namespace App\Repositories;

use App\Models\aactivities;
use App\Models\aprofile;
use App\Models\userskill;
use App\Repositories\Interfaces\UserskillRepositoryInterface;

class UserskillRepository implements UserskillRepositoryInterface
{

    public function all()
    {
        return userskill::where('skilluuid','1')->latest()->paginate(10);
    }

    public function Store($data)
    {
        return userskill::create($data);
    }

    public function findbyid($id)
    {
        return userskill::where('uuid',$id)->where('name','1')->get();
    }

     
    public function update($data)
    {
        $updates = userskill::where('uuid', $data['uuid'])->update([ 
            'skilluuid' => $data['skilluuid'],
            'useruuid' => $data['useruuid'] 

        ]);
        return $updates;
    } 
    
}