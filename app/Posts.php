<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Posts extends Model
{
	use SoftDeletes;

	protected $fillable = ['judul','category_id','content','gambar','slug','users_id'];

	// one to many
	public function category(){
		return $this->belongsTo('App\Category');
	}

	// many to many
	public function tags(){
		return $this->belongsToMany('App\Tags');
	}

	// user id
	public function users(){
		return $this->belongsTo('App\User');
	}
}
