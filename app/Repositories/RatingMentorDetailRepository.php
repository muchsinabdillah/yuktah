<?php

namespace App\Repositories; 
use App\Models\ratingmentor;
use App\Repositories\Interfaces\RatingMentorDetailRepositoryInterface;

class RatingMentorDetailRepository implements RatingMentorDetailRepositoryInterface
{

    public function all()
    {
        return ratingmentor::where('uuid','1')->latest()->paginate(10);
    }

    public function Store($data)
    {
        return ratingmentor::create($data);
    }

    public function findbyid($id)
    {
        return ratingmentor::where('uuid',$id)->where('name','1')->get();
    }

     
    public function update($data)
    {
        $updates = ratingmentor::where('uuid', $data['uuid'])->update([ 
            'name' => $data['name'] 
        ]);
        return $updates;
    } 
    
}