<?php

namespace App\Repositories;

use App\Models\aactivities;
use App\Models\aprofile;
use App\Models\carriereducation;
use App\Repositories\Interfaces\CarrierEducationRepositoryInterface;

class CarrierEducationRepository implements CarrierEducationRepositoryInterface
{

    public function all()
    {
        return carriereducation::where('name','alim')->latest()->paginate(10);
    }

    public function Store($data)
    {
        return carriereducation::create($data);
    }

    public function findbyid($id)
    {
        return carriereducation::where('uuid',$id)->where('name','alim')->get();
    }

     
    public function update($data)
    {
        $updates = carriereducation::where('uuid', $data['uuid'])->update([ 
            'useruuid' => $data['useruuid'], 
            'name' => $data['name'] 
        ]);
        return $updates;
    } 
    
}