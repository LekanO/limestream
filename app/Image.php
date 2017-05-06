<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = ['file_name', 'mime_type', 'file_size', 'file_path', 'status', 'type'];
    
    public function user()
    {
    	return $this->belongsTo('App\User');
    }

}