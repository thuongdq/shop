<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\EntrustPermission;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use App\Notifications\MyResetPassword as ResetPasswordNotification;

/**
 * App\User
 *
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \App\Product $products
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use Notifiable;
    use EntrustUserTrait;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        'phone',
        'interests',
        'occupation',
        'about',
        'website',
        'address'
    ];
    protected $table = 'tdq68_users';
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function products(){
        return $this->belongsTo('App\Product', 'user_id', 'id');
    }
    public function news(){
        return $this->belongsTo('App\News', 'user_id', 'id');
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }
}
