<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class userskill extends Model
{
    use HasFactory;
    protected $table = "userskills";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',     
        'skilluuid',
        'useruuid' 
    ];
    
    public $incrementing = true;
}
