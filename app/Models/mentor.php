<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mentor extends Model
{
    use HasFactory;
    protected $table = "mentors";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',     
        'useruuid',
        'name',
        'sex',
        'address',
        'companyname',
        'workpositionuuid',
        'dateofbirth',
        'ratingcount',
        'rating' 
    ];
    
    public $incrementing = true;
}
