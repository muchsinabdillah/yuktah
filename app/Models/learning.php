<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class learning extends Model
{
    use HasFactory;
    protected $table = "learnings";

    /**
     * The attributes that are mass assignable.s
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',     
        'useruuid',
        'title',
        'shortdescription',
        'studentcount',
        'ratingcount',
        'rating',
        'mentoruuid',
        'learndetail',
        'benefitcourse',
        'requirment',
        'description',
        'price',
        'cover',
        'totalmodul',
        'place',
        'contactperson',
        'gmaplocation',
        'learninggroupuuid',
        'learningeventuuid',
        'learningdate',
        'learninglevel',
        'status' 
    ];
    
    public $incrementing = true;
}
