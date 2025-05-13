<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class learningquestionnaire extends Model
{
     use HasFactory;
    protected $table = "learningquestionnaires";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',     
        'name', 
        'type', 
        'year', 
        'learninguuid' 
    ];
    
    public $incrementing = true;
}
