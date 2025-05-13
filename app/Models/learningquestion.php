<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class learningquestion extends Model
{
    use HasFactory;
    protected $table = "learningquestions";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',     
        'type',
        'year',
        'question',
        'answer',
        'learninguuid' 
    ];
    
    public $incrementing = true;
}
