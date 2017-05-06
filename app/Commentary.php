<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commentary extends Model
{
        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = ['user_id', 'video_id', 'body'];

    public function user() {
    	return $this->belongsTo('App\User');
    } 

    public function video() {
    	return $this->belongsTo('App\Video');
    } 
    
}