<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    public function students(){
        return $this->belongsToMany('App\Student','enrollments');
    }

    public function admin(){
        return $this->belongsTo('App\User');
}



}
