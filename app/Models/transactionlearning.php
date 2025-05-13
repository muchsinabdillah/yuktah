<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transactionlearning extends Model
{
    use HasFactory;
    protected $table = "transactionlearnings";

    protected $fillable = [
        'uuid',  
        'invoucenumber',  
        'useruuid',  
        'paymentid',  
        'paymentmethod',  
        'qty',  
        'price',  
        'discount',  
        'applicationfee',
        'paymentfee',
        'total',
        'promocode',
        'active',
        'date_void'
    ];
    
    public $incrementing = true;
}
