<?php

namespace App\Repositories;

use App\Models\aactivities;
use App\Models\aprofile;
use App\Models\province;
use App\Repositories\Interfaces\ProvinceRepositoryInterface;

class ProvinceRepository implements ProvinceRepositoryInterface
{

    public function all()
    {
        return province::where('uuid','1')->latest()->paginate(10);
    }

    public function Store($data)
    {
        return province::create($data);
    }

    public function findbyid($id)
    {
        return province::where('uuid',$id)->where('name','1')->get();
    }

     
    public function update($data)
    {
        $updates = province::where('uuid', $data['uuid'])->update([ 
            'name' => $data['name'] 
        ]);
        return $updates;
    } 
    
}