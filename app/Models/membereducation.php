<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class membereducation extends Model
{
    use HasFactory;
    protected $table = "membereducations";

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
