<?php

namespace App\Repositories;

use App\Models\aactivities;
use App\Models\aprofile;
use App\Models\carriergroup;
use App\Repositories\Interfaces\CarrierGroupRepositoryInterface;

class CarrierGroupRepository implements CarrierGroupRepositoryInterface
{

    public function all()
    {
        return carriergroup::where('active','1')->latest()->paginate(10);
    }

    public function Store($data)
    {
        return carriergroup::create($data);
    }

    public function findbyid($id)
    {
        return carriergroup::where('uuid',$id)->where('active','1')->get();
    }

     
    public function update($data)
    {
        $updates = carriergroup::where('uuid', $data['uuid'])->update([ 
            'useruuid' => $data['useruuid'], 
            'active' => $data['active'] 
        ]);
        return $updates;
    } 
    
}