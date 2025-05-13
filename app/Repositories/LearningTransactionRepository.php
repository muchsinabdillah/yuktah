<?php

namespace App\Repositories;
 
use App\Models\learningdetail;
use App\Models\transactionlearning;
use App\Models\transactionlearningdetail;
use App\Repositories\Interfaces\LearningTransactionRepositoryInterface;

class LearningTransactionRepository implements LearningTransactionRepositoryInterface
{
    public function all($useruuid)
    {
        return transactionlearning::where('useruuid',$useruuid)->latest()->paginate(10);
    } 
    public function alldetail($uuid)
    {
        return transactionlearningdetail::where('uuid',$uuid)->latest()->paginate(10);
    }
    public function Store($data)
    {
        return transactionlearning::create($data);
    }
    public function StoreDetail($uuid,$learninguuid,$price,$date_void)
    {
        return transactionlearningdetail::create([
            "uuid"=> $uuid,
            "learninguuid"=> $learninguuid,
            "price"=> $price,
            "active"=> 1,
            "date_void"=> $date_void
        ]);
    }
    public function delete($data)
    {
        return learningdetail::latest()->paginate(10);
    }
    public function findbyid($data)
    {
        return learningdetail::latest()->paginate(10);
    }
}