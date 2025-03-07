<?php

namespace App\Repositories;

use App\Models\aactivities;
use App\Models\aprofile;
use App\Models\carrierskill;
use App\Repositories\Interfaces\CarrierSkillRepositoryInterface;

class CarrierSkillRepository implements CarrierSkillRepositoryInterface
{

    public function all()
    {
        return carrierskill::latest()->paginate(10);
    }

    public function Store($data)
    {
        return carrierskill::create($data);
    }

    public function findbyid($id)
    {
        return carrierskill::where('uuid',$id)->get();
    }

     
    public function update($data)
    {
        $updates = carrierskill::where('uuid', $data['uuid'])->update([ 
            'useruuid' => $data['useruuid'], 
            'name' => $data['name'] 
        ]);
        return $updates;
    } 
    
}