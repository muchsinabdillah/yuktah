<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class carrierindustrialsector extends Model
{
    use HasFactory;
    protected $table = "carrierindustrialsectors";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',     
        'useruuid',
        'name' 
    ];
    
    public $incrementing = true;
}
