<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
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

    protected $fillable = ['address1', 'address2', 'city', 'country', 'post_code', 'tel'];
    
}