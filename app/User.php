<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'name', 'username', 'email', 'password', 'status', 'parent_1', 'parent_2', 'parent_3', 'parent_4', 'parent_5', 'parent_6', 'parent_7', 'parent_8', 'referral_id', 'package_id', 'active_status'
        , 'profile_image', 'role_status', 'suspend_status', 'referral_code'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function accounts(){
        return $this->hasOne(Account::class);
    }

    public function packages(){
        return $this->hasOne(Package::class);
    }

    public function summarys(){
        return $this->hasMany(Summary::class);
    }

    public function advertisements(){
        return $this->hasMany(Advertisement::class);
    }

    public function parent_users() {
        return $this->belongsTo(User::class,'parent_1');
    }

    public function child_users() {
        return $this->hasMany(User::class,'parent_1');
    }
}
