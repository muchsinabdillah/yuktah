<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class trslearningposttest extends Model
{
    use HasFactory;
    protected $table = "trslearningposttests";

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
