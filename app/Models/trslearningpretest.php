<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class trslearningpretest extends Model
{
    use HasFactory;
    protected $table = "trslearningpretests";

    protected $fillable = [
        'uuid',
        'learningtransactiondetail',
        'score',
        'year',
        'user_created',
        'created_at',
        'updated_at'
    ];
    
    public $incrementing = true;
}
