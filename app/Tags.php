<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tags extends Model
{
    protected $fillable = ['name','slug'];
    protected $table = 'tags';

    // many to many
	public function posts(){
		return $this->belongsToMany('App\Pots');
	}
}
