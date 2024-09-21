<?php

namespace App\Repositories;

use App\Models\aactivities;
use App\Models\aprofile;
use App\Models\memberworkhistorie;
use App\Repositories\Interfaces\MemberworkhistorieRepositoryInterface;

class MemberworkhistorieRepository implements MemberworkhistorieRepositoryInterface
{

    public function all()
    {
        return memberworkhistorie::where('workplace','1')->latest()->paginate(10);
    }

    public function Store($data)
    {
        return memberworkhistorie::create($data);
    }

    public function findbyid($id)
    {
        return memberworkhistorie::where('uuid',$id)->where('workplace','1')->get();
    }

     
    public function update($data)
    {
        $updates = memberworkhistorie::where('uuid', $data['uuid'])->update([ 
            'memberuuid'=> $data['memberuuid'],
            'workplace'=> $data['workplace'],
            'datestart'=> $data['datestart'],
            'dateend'=> $data['dateend'],
            'active'=> $data['active']
        ]);
        return $updates;
    } 
    
}