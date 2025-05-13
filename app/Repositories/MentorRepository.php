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
        return mentor::latest()->paginate(10);
    }

    public function Store($data)
    {
        return mentor::create($data);
    }

    public function findbyid($id)
    {
        return mentor::where('uuid',$id)->get();
    }
    public function findbyUseruuid($id)
    {
        return mentor::where('useruuid',$id)->get();
    }
     
    public function update($data)
    {
        $updates = mentor::where('uuid', $data['uuid'])->update($data);
        return $updates;
    } 
    
}