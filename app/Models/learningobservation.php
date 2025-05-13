<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class learningobservation extends Model
{
    use HasFactory;
    protected $table = "learningobservations";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',     
        'question',
        'year',  
        'learninguuid' 
    ];
    
    public $incrementing = true;
}
