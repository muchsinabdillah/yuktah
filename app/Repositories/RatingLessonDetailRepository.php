<?php

namespace App\Repositories; 
use App\Models\ratinglesson;
use App\Repositories\Interfaces\RatingLessonDetailRepositoryInterface; 

class RatingLessonDetailRepository implements RatingLessonDetailRepositoryInterface
{

    public function all()
    {
        return ratinglesson::where('uuid','1')->latest()->paginate(10);
    }

    public function Store($data)
    {
        return ratinglesson::create($data);
    }

    public function findbyid($id)
    {
        return ratinglesson::where('uuid',$id)->where('name','1')->get();
    }

     
    public function update($data)
    {
        $updates = ratinglesson::where('uuid', $data['uuid'])->update([ 
            'name' => $data['name'] 
        ]);
        return $updates;
    } 
    
}