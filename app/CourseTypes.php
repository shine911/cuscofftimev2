<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Courses;
class CourseTypes extends Model
{
    //
    protected $table = 'course_types';
    public $timestamps = false;
    public function Courses(){
        return $this->hasMany('App\Courses', 'type_id', 'id');
    }
}
