<?php

namespace App\Repositories;

use App\Models\aactivities;
use App\Models\aprofile;
use App\Models\carrier;
use App\Repositories\Interfaces\CarrierRepositoryInterface;

class CarrierRepository implements CarrierRepositoryInterface
{

    public function all()
    {
        return carrier::where('carriergroupuuid','alim')->latest()->paginate(10);
    }

    public function Store($data)
    {
        return carrier::create($data);
    }

    public function findbyid($id)
    {
        return carrier::where('uuid',$id)->where('carriergroupuuid','alim')->get();
    }

     
    public function update($data)
    {
        $updates = carrier::where('uuid', $data['uuid'])->update([ 
            'useruuid' => $data['useruuid'], 
            'carriergroupuuid'=> $data['carriergroupuuid'],
            'industrialuuid'=> $data['industrialuuid'],
            'educationuuid'=> $data['educationuuid'],
            'requirmentuuid'=> $data['requirmentuuid'],
            'companyuuid'=> $data['companyuuid'],
            'provinceuuid'=> $data['provinceuuid'],
            'regencyuuid'=> $data['regencyuuid'],
            'title'=> $data['title'],
            'personrequirment'=> $data['personrequirment'],
            'duedate'=> $data['duedate'],
            'description'=> $data['description'],
            'qualification'=> $data['qualification'],
            'status' => $data['status']
        ]);
        return $updates;
    } 
    
}