<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class userworkexperience extends Model
{
    use HasFactory;
    protected $table = "userworkexperiences";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',     
        'useruuid',
        'name',
        'dateworkstart',
        'dateworkend'

    ];
    
    public $incrementing = true;
}
