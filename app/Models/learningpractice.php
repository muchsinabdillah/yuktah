<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class learningpractice extends Model
{
    use HasFactory;
    protected $table = "learningpractices";

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
