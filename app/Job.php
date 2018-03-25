<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User' , 'user_id');
    }


    public function requests()
    {
        return $this->hasMany('App\Request' , 'job_id');
    }
}
