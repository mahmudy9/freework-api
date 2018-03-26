<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens,Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone' , 'address' , 'city'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function hasRole($role)
    {
        if($this->roles()->where('name' , $role)->first())
        {
            return true;
        }
        return false;
    }


    public function roles()
    {
        return $this->belongsToMany( 'App\Role' , 'role_user' , 'user_id' , 'role_id');
    }


    public function jobs()
    {
        return $this->hasMany( 'App\Job' ,'user_id');
    }


    public function contacts()
    {
        return $this->hasMany('App\Contact' , 'user_id');
    }


    public function requests()
    {
        return $this->hasMany('App\Request' , 'freelancer_id');
    }



}
