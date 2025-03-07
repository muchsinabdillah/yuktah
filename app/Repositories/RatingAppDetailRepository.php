<?php

namespace App\Repositories; 
use App\Models\ratingapp;
use App\Repositories\Interfaces\RatingAppDetailRepositoryInterface;

class RatingAppDetailRepository implements RatingAppDetailRepositoryInterface
{

    public function all()
    {
        return ratingapp::latest()->paginate(10);
    }

    public function Store($data)
    {
        return ratingapp::create($data);
    }

    public function findbyid($id)
    {
        return ratingapp::where('uuid',$id)->get();
    }

     
    public function update($data)
    {
        $updates = ratingapp::where('uuid', $data['uuid'])->update([  
            'ratingvalue' => $data['ratingvalue'],
            'Comment' => $data['Comment'] 
        ]);
        return $updates;
    } 
    
}