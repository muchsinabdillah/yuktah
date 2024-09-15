<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class workposition extends Model
{
    use HasFactory;
    protected $table = "workpositions";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',     
        'useruuid',
        'name' 
    ];
    
    public $incrementing = true;
}
