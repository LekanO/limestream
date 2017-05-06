<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function file()
    {
    	return $this->belongsTo('App/File');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    public $fillable = ['name', 'description', 'price', 'imageurl'];
}
