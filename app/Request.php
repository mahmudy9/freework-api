<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    public function job()
    {
        return $this->belongsTo('App\Job' , 'job_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User' , 'freelancer_id');
    }
}
