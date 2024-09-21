<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class memberworkhistorie extends Model
{
    use HasFactory;
    protected $table = "memberworkhistories";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',     
        'memberuuid',
        'workplace',
        'datestart',
        'dateend',
        'active'
    ];
    
    public $incrementing = true;
}
