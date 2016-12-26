<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model {

	protected $fillable = ['content'];

	public function user() {
		return $this->belongsTo(User::class);
	}

	public function comments() {
		return $this->morphMany(Comment::class, 'commentable');
	}

	public function likes() {
		return $this->morphMany(Like::class, 'likeable');
	}
}