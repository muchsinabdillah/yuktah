<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class learningdetail extends Model
{
    use HasFactory;
    protected $table = "learningdetails";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',     
        'useruuid',
        'description',
        'type',
        'urldocument',
        'learninguuid'
    ];
    
    public $incrementing = true;
}
