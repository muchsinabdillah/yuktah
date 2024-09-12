<?php

namespace App\Repositories;

use App\Models\aactivities;
use App\Models\aprofile;
use App\Models\userworkexperience;
use App\Repositories\Interfaces\UserworkexperienceRepositoryInterface;

class UserworkexperienceRepository implements UserworkexperienceRepositoryInterface
{

    public function all()
    {
        return userworkexperience::where('useruuid','1')->latest()->paginate(10);
    }

    public function Store($data)
    {
        return userworkexperience::create($data);
    }

    public function findbyid($id)
    {
        return userworkexperience::where('uuid',$id)->where('name','1')->get();
    }

     
    public function update($data)
    {
        $updates = userworkexperience::where('uuid', $data['uuid'])->update([ 
            'useruuid' => $data['useruuid'], 
            'name' => $data['name'],
            'dateworkstart' => $data['dateworkstart'],
            'dateworkend' => $data['dateworkend']

        ]);
        return $updates;
    } 
    
}