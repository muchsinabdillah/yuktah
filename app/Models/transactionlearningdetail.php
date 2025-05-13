<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transactionlearningdetail extends Model
{
    use HasFactory;
    protected $table = "transactionlearningdetails";

    protected $fillable = [
        'uuid',     
        'learninguuid',
        'price',
        'active',
        'date_void' 
    ];
    
    public $incrementing = true;
}
