<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
	public $perPage = 5;

	public function user() {
		return $this->belongsTo(User::class);
	}

	public function category() {
		return $this->belongsTo(Category::class);
	}

    public function comments() {
    	return $this->morphMany(Comment::class, 'commentable');
    }
}
