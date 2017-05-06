<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
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

    public $fillable = ['user_id', 'title', 'src', 'poster', 'type'];


    public function quiz()
    {
     return $this->hasOne('App\Quiz');
    }

    public function comments()
    {
     return $this->hasMany('App\Comment');
    }

    public function commentary() {
        return $this->hasMany('App\Commentary');
    } 
}
