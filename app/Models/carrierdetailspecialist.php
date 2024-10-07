<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class carrierdetailspecialist extends Model
{
    use HasFactory;
    protected $table = "carrierdetailspecialists";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',     
        'carrieruuid',
        'carrierspecialistuuid' 
    ];
    
    public $incrementing = true;
}
