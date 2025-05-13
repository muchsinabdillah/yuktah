<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class trslearningpracticetestdetail extends Model
{
    use HasFactory;
    protected $table = "trslearningpracticetestdetails";

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
