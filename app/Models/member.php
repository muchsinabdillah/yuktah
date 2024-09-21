<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class member extends Model
{
    use HasFactory;
    protected $table = "members";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',     
        // 'useruuid',
        'name',
        'email',
        'address',
        'dateofbirth',
        'gender',
        'education',
        'typeofmember'
    ];
    
    public $incrementing = true;
}
