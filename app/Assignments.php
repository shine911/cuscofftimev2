<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assignments extends Model
{
    //
    protected $table = 'assignments';

    public function Class(){
        return $this->belongsTo('App\Classroom', 'class_id', 'id');
    }

    public function Subject(){
        return $this->belongsTo('App\Subject', 'sub_id', 'id');
    }

    public function User(){
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

}