<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Courses;
class Subjects extends Model
{
    //
    protected $table = 'subjects';

    protected $fillable = ['name', 'amount', 'semester', 'course_id'];

    public $timestamps = false;

    public function Course(){
        return $this->belongsTo('App\Courses', 'course_id', 'id');
    }
}
