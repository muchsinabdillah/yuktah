<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class companie extends Model
{
    use HasFactory;
    protected $table = "companies";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',     
        'provinceuuid',
        'regencieuuid',
        'name',
        'photo',
        'gmap',
        'status',
        'about'   
];
    
    public $incrementing = true;
}
