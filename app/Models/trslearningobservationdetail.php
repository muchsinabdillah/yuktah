<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class trslearningobservationdetail extends Model
{
    use HasFactory;
    protected $table = "trslearningobservationdetails";

    protected $fillable = [
        'uuid',
        'answer', 
        'uuidheader',
        'uuidquestion',
        'score', 
        'isanswer',
        'created_at',
        'updated_at'
    ];
    
    public $incrementing = true;
}
