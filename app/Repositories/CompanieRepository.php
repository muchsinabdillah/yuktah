<?php

namespace App\Repositories;

use App\Models\aactivities;
use App\Models\aprofile;
use App\Models\companie;
use App\Repositories\Interfaces\CompanieRepositoryInterface;

class CompanieRepository implements CompanieRepositoryInterface
{

    public function all()
    {
        return companie::where('companiegroupuuid','alim')->latest()->paginate(10);
    }

    public function Store($data)
    {
        return companie::create($data);
    }

    public function findbyid($id)
    {
        return companie::where('uuid',$id)->where('companiegroupuuid','alim')->get();
    }

     
    public function update($data)
    {
        $updates = companie::where('uuid', $data['uuid'])->update([ 
            'province' => $data['province'], 
            'regencieuuid'=> $data['regencieuuid'],
            'name'=> $data['name'],
            'photo'=> $data['photo'],
            'gmap'=> $data['gmap'],
            'status'=> $data['status'],
            'about'=> $data['about']
        ]);
        return $updates;
    } 
    
}