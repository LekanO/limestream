<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Live extends Model
{
	
    public function user()
    {
     return $this->belongsTo('App\User');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    public $fillable = ['title', 'src'];


    public function quiz()
    {
     return $this->hasOne('App\Quiz');
    }
}
