<?php

namespace App\Models;

use App\Notifications\ResetPasswordNotification;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, CanResetPassword;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [ 
            'uuid',
            'email',
            'firstname',
            'lastname',
            'dateofbirth',
            'gender',
            'mobilephone' ,
            'domicilieprovince' ,
            'domicilieprovincename' ,
            'domicilieregency' ,
            'domicilieregencyname' ,
            'domicilieaddress' ,
            'referalcode',
            'socialmedia_fb',
            'socialmedia_twiter',
            'socialmedia_linkedin',
            'socialmedia_ig',
            'socialmedia_line',
            'expectedsalary',
            'expectedposition',
            'expectedpositionname',
            'workoutdomicilie',
            'typeofmember',
            'privillage',
            'nip',
            'dept_id',
            'dept_name',
            'unit_id',
            'unit_name',
            'position_id',
            'position_name',
            'password' 
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }
}
