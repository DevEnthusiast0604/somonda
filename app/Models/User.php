<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;
use \Spatie\WelcomeNotification\ReceivesWelcomeNotification;


class User extends Authenticatable  
{
    use HasFactory, Notifiable, Billable;

    const ADMIN_TYPE = 1;
    const USER_TYPE = 2;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username','email','password','phone','type',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isAdmin(){
        return $this->type === self::ADMIN_TYPE;
    }

    public function profile_status(){
        return $this->hasMany('App\Models\Profile');
    }

    public function sales(){
        return $this->hasMany('App\Models\Sale');
    }

}
