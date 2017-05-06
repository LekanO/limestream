<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserImage extends Model
{
      protected $table = 'user_images';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = ['user_id', 'file_id'];
    
    public function user()
    {
    	return $this->belongsTo('App\User');
    }
}
