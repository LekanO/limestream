<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Description extends Model
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

    public $fillable = ['description', 'organisation', 'img', 'favourite_quote'];

}




