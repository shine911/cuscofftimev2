<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Subjects;
use App\CourseTypes;
class Courses extends Model
{
    //
    protected $table = 'courses';

    protected $fillable = ['name', 'type_id'];

    public $timestamps = false;
    
    public function CourseType(){
        return $this->belongsTo('App\CourseTypes', 'type_id', 'id');
    }

    public function Subject(){
        return $this->hasMany('App\Subjects', 'course_id', 'id');
    }
}
