<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class trslearningkuisionerdetail extends Model
{
    use HasFactory;
    protected $table = "trslearningkuisionerdetails";

    protected $fillable = [
        'uuid',
        'uuidheader',
        'uuidquestion',
        'answer',
        'istrue',
        'score', 
        'created_at',
        'updated_at'
    ];
    
    public $incrementing = true;
}
