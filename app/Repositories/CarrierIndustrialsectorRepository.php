<?php

namespace App\Repositories;

use App\Models\aactivities;
use App\Models\aprofile;
use App\Models\carrierindustrialsector;
use App\Repositories\Interfaces\CarrierIndustrialsectorRepositoryInterface;

class CarrierIndustrialsectorRepository implements CarrierIndustrialsectorRepositoryInterface
{

    public function all()
    {
        return carrierindustrialsector::where('name','alim')->latest()->paginate(10);
    }

    public function Store($data)
    {
        return carrierindustrialsector::create($data);
    }

    public function findbyid($id)
    {
        return carrierindustrialsector::where('uuid',$id)->where('name','alim')->get();
    }

     
    public function update($data)
    {
        $updates = carrierindustrialsector::where('uuid', $data['uuid'])->update([ 
            'useruuid' => $data['useruuid'], 
            'name' => $data['name'] 
        ]);
        return $updates;
    } 
    
}