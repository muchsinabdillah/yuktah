<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class trslearningkuisioner extends Model
{
    use HasFactory;
    protected $table = "trslearningkuisioners";

    protected $fillable = [
        'uuid',
        'learningtransactiondetail',
        'score',
        'year',
        'user_created' 
    ];
    
    public $incrementing = true;
}