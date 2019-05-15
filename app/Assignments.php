<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assignments extends Model
{
    //
    protected $table = 'assignments';
    
    protected $fillable = ['user_id', 'sub_id', 'time_start', 'time_end', 'class_id'];

    public $timestamps = false;

    public function Class(){
        return $this->belongsTo('App\Classroom', 'class_id', 'id');
    }

    public function Subject(){
        return $this->belongsTo('App\Subjects', 'sub_id', 'id');
    }

    public function User(){
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

}
