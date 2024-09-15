<?php

namespace App\Repositories;

use App\Models\aactivities;
use App\Models\aprofile;
use App\Models\mentor;
use App\Repositories\Interfaces\MentorRepositoryInterface;

class MentorRepository implements MentorRepositoryInterface
{

    public function all()
    {
        return mentor::where('name','tes')->latest()->paginate(10);
    }

    public function Store($data)
    {
        return mentor::create($data);
    }

    public function findbyid($id)
    {
        return mentor::where('uuid',$id)->where('name','tes')->get();
    }

     
    public function update($data)
    {
        $updates = mentor::where('uuid', $data['uuid'])->update([ 
            'useruuid' => $data['useruuid'], 
            'name' => $data['name'],
            'sex'=> $data['sex'],
            'address'=> $data['address'],
            'companyname'=> $data['companyname'],
            'workpositionuuid'=> $data['workpositionuuid'],
            'dateofbirth'=> $data['dateofbirth'],
            'ratingcount'=> $data['ratingcount'],
            'rating' => $data['rating']
        ]);
        return $updates;
    } 
    
}