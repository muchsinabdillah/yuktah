<?php

namespace App\Repositories;

use App\Models\aactivities;
use App\Models\aprofile;
use App\Models\member;
use App\Repositories\Interfaces\MemberRepositoryInterface;

class MemberRepository implements MemberRepositoryInterface
{

    public function all()
    {
        return member::where('name','1')->latest()->paginate(10);
    }

    public function Store($data)
    {
        return member::create($data);
    }

    public function findbyid($id)
    {
        return member::where('uuid',$id)->where('name','1')->get();
    }

     
    public function update($data)
    {
        $updates = member::where('uuid', $data['uuid'])->update([ 
            // 'useruuid' => $data['useruuid'], 
            'name' => $data['name'],
            'email'=> $data['email'],
            'address'=> $data['address'],
            'dateofbirth'=> $data['dateofbirth'],
            'gender'=> $data['gender'],
            'education'=> $data['education'],
            'typeofmember' => $data['typeofmember']
        ]);
        return $updates;
    } 
    
}