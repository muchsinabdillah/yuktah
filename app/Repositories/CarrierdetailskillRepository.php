<?php

namespace App\Repositories;

use App\Models\aactivities;
use App\Models\aprofile;
use App\Models\carrierdetailskill;
use App\Repositories\Interfaces\CarrierdetailskillRepositoryInterface;

class CarrierdetailskillRepository implements CarrierdetailskillRepositoryInterface
{

    public function all()
    {
        return carrierdetailskill::latest()->paginate(10);
    }

    public function Store($data)
    {
        return carrierdetailskill::create($data);
    }

    public function findbyid($id)
    {
        return carrierdetailskill::where('uuid',$id)->get();
    }

     
    public function update($data)
    {
        $updates = carrierdetailskill::where('uuid', $data['uuid'])->update([ 
            'carrieruuid' => $data['carrieruuid'], 
            'carrierskilluuid' => $data['carrierskilluuid']
        ]);
        return $updates;
    } 
    
}