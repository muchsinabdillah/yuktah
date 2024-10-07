<?php

namespace App\Repositories;

use App\Models\aactivities;
use App\Models\aprofile;
use App\Models\regencie;
use App\Repositories\Interfaces\RegencieRepositoryInterface;

class RegencieRepository implements RegencieRepositoryInterface
{

    public function all()
    {
        return regencie::where('uuid','1')->latest()->paginate(10);
    }

    public function Store($data)
    {
        return regencie::create($data);
    }

    public function findbyid($id)
    {
        return regencie::where('uuid',$id)->where('name','1')->get();
    }

     
    public function update($data)
    {
        $updates = regencie::where('uuid', $data['uuid'])->update([ 
            'name' => $data['name'] 
        ]);
        return $updates;
    } 
    
}