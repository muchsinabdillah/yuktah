<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class trslearningpracticetest extends Model
{
    use HasFactory;
    protected $table = "trslearningpracticetests";

    protected $fillable = [
        'uuid',
        'learningtransactiondetail',
        'score',
        'year',
        'photo1',
        'photo2',
        'photo3',
        'photo4',
        'photo5',
        'user_created',
        'created_at',
        'updated_at'
    ];
    
    public $incrementing = true;
}
