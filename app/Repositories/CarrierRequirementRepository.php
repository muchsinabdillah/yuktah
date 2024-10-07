<?php

namespace App\Repositories;

use App\Models\aactivities;
use App\Models\aprofile;
use App\Models\carrierrequirement;
use App\Repositories\Interfaces\CarrierRequirementRepositoryInterface;

class CarrierRequirementRepository implements CarrierRequirementRepositoryInterface
{

    public function all()
    {
        return carrierrequirement::where('name','alim')->latest()->paginate(10);
    }

    public function Store($data)
    {
        return carrierrequirement::create($data);
    }

    public function findbyid($id)
    {
        return carrierrequirement::where('uuid',$id)->where('name','alim')->get();
    }

     
    public function update($data)
    {
        $updates = carrierrequirement::where('uuid', $data['uuid'])->update([ 
            'useruuid' => $data['useruuid'], 
            'name' => $data['name'] 
        ]);
        return $updates;
    } 
    
}