<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class carrierdetailskill extends Model
{
    use HasFactory;
    protected $table = "carrierdetailskills";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',     
        'carrieruuid',
        'carrierskilluuid' 
    ];
    
    public $incrementing = true;
}
