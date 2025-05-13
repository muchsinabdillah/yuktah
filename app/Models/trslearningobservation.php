<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class trslearningobservation extends Model
{
    use HasFactory;
    protected $table = "trslearningobservations";

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
