<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offdays extends Model
{
    //
    protected $table = 'offdays';
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'user_id' ,'class_id', 'time_start', 'time_end', 'reason', 'amount', 'date'
    ];

    public function User(){
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function Class(){
        return $this->belongsTo('App\Classroom', 'class_id', 'id');
    }
}
