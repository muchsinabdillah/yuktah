<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class trslearningposttestdetail extends Model
{
    use HasFactory;
    protected $table = "trslearningposttestdetails";

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
