<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Courses extends Model
{
    //
    protected $table = 'courses';

    protected $fillable = ['name', 'type_id'];

    public $timestamps = false;
}
