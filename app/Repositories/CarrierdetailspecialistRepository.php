<?php

namespace App\Repositories;

use App\Models\aactivities;
use App\Models\aprofile;
use App\Models\carrierdetailspecialist;
use App\Repositories\Interfaces\CarrierdetailspecialistRepositoryInterface;

class CarrierdetailspecialistRepository implements CarrierdetailspecialistRepositoryInterface
{

    public function all()
    {
        return carrierdetailspecialist::where('carrierspecialistuuid','1')->latest()->paginate(10);
    }

    public function Store($data)
    {
        return carrierdetailspecialist::create($data);
    }

    public function findbyid($id)
    {
        return carrierdetailspecialist::where('uuid',$id)->where('name','1')->get();
    }

     
    public function update($data)
    {
        $updates = carrierdetailspecialist::where('uuid', $data['uuid'])->update([ 
            'carrieruuid' => $data['carrieruuid'], 
            'carrierspecialistuuid' => $data['carrierspecialistuuid']
        ]);
        return $updates;
    } 
    
}