<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    //
    protected $table = 'class_room';

    protected $fillable = ['name', 'is_overtime'];

    public $timestamps = false;

    public function Assignments(){
        return $this->hasMany('App\Assignments', 'class_id', 'id');
    }
}
