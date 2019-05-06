<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subjects extends Model
{
    //
    protected $table = 'subjects';

    protected $fillable = ['name', 'amount', 'semester', 'course_id'];

    public $timestamps = false;
}
