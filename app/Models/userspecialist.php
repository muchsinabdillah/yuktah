<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class userspecialist extends Model
{
    use HasFactory;
    protected $table = "userspecialists";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',     
        'specialistuuid',
        'useruuid' 
    ];
    
    public $incrementing = true;
}
