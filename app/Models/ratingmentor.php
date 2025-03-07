<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ratingmentor extends Model
{
    use HasFactory;
    protected $table = "ratingmentors";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',     
        'memberuuid',
        'education',
        'graduationdate',
        'active'
    ];
    
    public $incrementing = true;
}
