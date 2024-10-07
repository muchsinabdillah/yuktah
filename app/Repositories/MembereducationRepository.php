<?php

namespace App\Repositories;

use App\Models\aactivities;
use App\Models\aprofile;
use App\Models\membereducation;
use App\Repositories\Interfaces\MembereducationRepositoryInterface;

class MembereducationRepository implements MembereducationRepositoryInterface
{

    public function all()
    {
        return membereducation::where('education','1')->latest()->paginate(10);
    }

    public function Store($data)
    {
        return membereducation::create($data);
    }

    public function findbyid($id)
    {
        return membereducation::where('uuid',$id)->where('education','1')->get();
    }

     
    public function update($data)
    {
        $updates = membereducation::where('uuid', $data['uuid'])->update([ 
            'memberuuid'=> $data['memberuuid'],
            'education'=> $data['education'],
            'graduationdate'=> $data['graduationdate'],
            'active'=> $data['active']
        ]);
        return $updates;
    } 
    
}