<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ratingapp extends Model
{
    use HasFactory;
    protected $table = "ratingapps";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>a
     */
    protected $fillable = [
        'uuid',     
        'memberuuid',
        'ratingvalue',
        'Comment' 
    ];
    
    public $incrementing = true;
}
