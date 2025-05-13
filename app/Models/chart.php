<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class chart extends Model
{
    use HasFactory;
    protected $table = "charts";

    protected $fillable = [
        'uuid',     
        'useruuid',
        'learninguuid',
        'price' 
    ];
    
    public $incrementing = true;
}
