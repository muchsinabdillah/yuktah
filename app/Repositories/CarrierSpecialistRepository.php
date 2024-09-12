<?php

namespace App\Repositories;

use App\Models\aactivities;
use App\Models\aprofile;
use App\Models\carrierspecialist;
use App\Repositories\Interfaces\CarrierSpecialistRepositoryInterface;

class CarrierSpecialistRepository implements CarrierSpecialistRepositoryInterface
{

    public function all()
    {
        return carrierspecialist::where('name','alim')->latest()->paginate(10);
    }

    public function Store($data)
    {
        return carrierspecialist::create($data);
    }

    public function findbyid($id)
    {
        return carrierspecialist::where('uuid',$id)->where('name','alim')->get();
    }

     
    public function update($data)
    {
        $updates = carrierspecialist::where('uuid', $data['uuid'])->update([ 
            'useruuid' => $data['useruuid'], 
            'name' => $data['name'] 
        ]);
        return $updates;
    } 
    
}