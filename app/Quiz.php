<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{

   public function video() 
    {
     return $this->belongsTo('App\Video');
    }


    public function answer()
    {
     return $this->hasOne('App\Answer');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    public $fillable = ['index', 'showAt', 'correct', 'show', 'question'];

}
