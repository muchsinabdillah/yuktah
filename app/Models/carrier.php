<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class carrier extends Model
{
    use HasFactory;
    protected $table = "carriers";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',     
        'useruuid',
        'carriergroupuuid',
        'industrialuuid',
        'educationuuid',
        'requirmentuuid',
        'companyuuid',
        'provinceuuid',
        'regencyuuid',
        'title',
        'personrequirment',
        'duedate',
        'description',
        'qualification',
        'status'    
];
    
    public $incrementing = true;
}
